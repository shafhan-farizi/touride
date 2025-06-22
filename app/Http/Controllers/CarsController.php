<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Cars;
use App\Models\PaymentMethods;
use App\Models\Payments;
use App\Models\Reviews;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class CarsController extends Controller
{
    protected $is_booking = false;

    public function isBooking() {
        $latest_booking = Bookings::latest()->where('user_id', Auth::user()->id)->first() ?? '';

        if($latest_booking) {
            $this->is_booking = $latest_booking->status == 'ongoing' || $latest_booking->status == 'upcoming';
        }

        return $this->is_booking;
    }
    
    public function index()
    {
        $cars = Cars::all();

        $is_booking = self::isBooking();

        return view('cars.index', compact(['cars', 'is_booking']));
    }

    public function show($id)
    {
        $car = Cars::find($id);

        $reviews = Reviews::with(['user', 'car'])->where('car_id', $id)->get(); 

        $rating = round(Reviews::where('car_id', $car->id)->get()->avg('rating'), 1);

        $is_booking = self::isBooking();

        return view('cars.show', compact(['car', 'rating', 'is_booking', 'reviews']));
    }

    public function booking($id)
    {
        $car = Cars::find($id);

        return view('cars.booking', compact('car'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'pickup_date' => 'required',
            'return_date' => 'required',
            'pickup_location' => 'required',
            'dropoff_location' => 'required',
        ]);

        // if ($validator->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $latest_booking_id = Bookings::latest('id')->first()->booking_id ?? 0;

        $from_date = Carbon::createFromFormat('Y-m-d\TH:i', $request->pickup_date);
        $to_date = Carbon::createFromFormat('Y-m-d\TH:i', $request->return_date);

        $period = intval($from_date->diffInDays($to_date));

        $latest_payment_id = Payments::latest('id')->first()->payment_id ?? 0;

        $payment = Payments::create([
            'payment_id' => str_pad($latest_payment_id + 1, 4, 0, STR_PAD_LEFT),
            'amount' => $period * Cars::find($request->car_id)->rental_price
        ]);

        $car_update_status = Cars::find($request->car_id)->update([
            'status' => 'rented'
        ]);

        // send notification to admin
        NotificationController::toAdmin('Pengajuan Booking', Auth::user()->name . ' mengajukan booking!');

        Bookings::create([
            'booking_id' => str_pad($latest_booking_id + 1, 4, 0, STR_PAD_LEFT),
            'user_id' => Auth::user()->id,
            'payment_id' => $payment->id,
            'car_id' => $request->car_id,
            'period' => $period,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'pickup_location' => $request->pickup_location,
            'dropoff_location' => $request->dropoff_location,
        ]);

        Alert::success('Success', 'Goodjob');

        return redirect()->route('user.history');
    }

    public function confirm($id) {
        $booking = Bookings::find($id);
        $payment_methods = PaymentMethods::where('user_id', 1)->get();
        $user = User::find(Auth::user()->id);

        return view('cars.confirm-booking', compact(['booking', 'payment_methods', 'user']));
    }

    public function confirmed(Request $request, $id) {
        $booking = Bookings::find($id);

        // $booking->update([
        //     'status' => 'ongoing',
        // ]);

        $payment = Payments::find($booking->payment_id);

        $payment->update([
            'status' => 'paid',
            'payment_method_id' => $request->payment_method_id
        ]);

        // Send to admin
        NotificationController::toAdmin('Transaksi Masuk', Auth::user()->name . ' telah membayar tagihan!');

        Alert::success('Success', 'Mantap');

        return redirect()->route('user.history');
    }
}

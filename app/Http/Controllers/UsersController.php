<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\PaymentMethods;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    public function booking_history()
    {
        // $bookings = Bookings::with(['payment.payment_method'])->where('user_id', Auth::user()->id)->get();
        $bookings = Bookings::query()
            ->join('payments', 'bookings.payment_id', '=', 'payments.id')
            ->leftjoin('payment_methods', 'payments.payment_method_id', '=', 'payment_methods.id')
            ->join('cars', 'bookings.car_id', '=', 'cars.id')
            ->select('bookings.id', 'bookings.booking_id', 'cars.name', 'bookings.period', 'payment_methods.bank_name', 'payments.amount', 'bookings.status')
            ->where('bookings.user_id', Auth::user()->id)
            ->orderBy('bookings.updated_at', 'desc')
            ->get();

        return view('user.history', compact('bookings'));
    }

    public function booking_history_detail($id)
    {
        $booking = Bookings::with(['payment.payment_method', 'car'])->find($id);
        $review = Reviews::with(['reply'])->where('booking_id', $id)->get();

        if ($review->isEmpty()) {
            $review[0] = collect([
                'rating' => 0,
                'description' => ''
            ]);
        }

        $can_rating = $booking->status == 'completed';

        return view('user.history-detail', [
            'booking' => $booking,
            'review' => $review[0],
            'can_rating' => $can_rating
        ]);
    }

    public function send_review(Request $request, $id)
    {
        $booking = Bookings::find($id);

        Reviews::create([
            'booking_id' => $id,
            'car_id' => $booking->car->id,
            'user_id' => Auth::user()->id,
            'rating' => $request->rating,
            'description' => $request->description
        ]);

        Alert::success('Success', 'Terima Kasih atas Reviewnya');

        return redirect()->route('user.history');
    }

    public function payment_method_add(Request $request, $id)
    {
        PaymentMethods::create([
            'user_id' => $id,
            'bank_name' => $request->bank_name,
            'pin' => $request->pin,
            'type' => in_array($request->bank_name, ['Jago', 'Mandiri', 'BCA', 'BRI']) ? 'atm' : 'phone'
        ]);

        Alert::success('Success', 'Berhasil Menambahkan Metode Pembayaran');

        return redirect()->route('user.payment-method');
    }

    public function payment_method()
    {
        $payment_methods = PaymentMethods::where('user_id', Auth::user()->id)->get();

        return view('user.payment-card', compact('payment_methods'));
    }

    public function payment_delete(Request $request)
    {
        PaymentMethods::find($request->delete_id)->delete();

        Alert::success('Success', 'Data Berhasil Dihapus');

        return redirect()->back();
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);

        return view('user.profile', compact('user'));
    }
}

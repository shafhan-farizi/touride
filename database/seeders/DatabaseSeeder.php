<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Cars;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);
        $customer = User::create([
            'name' => fake()->name(),
            'email' => 'a@g.c',
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('a'),
            'remember_token' => Str::random(10),
        ]);

        $customer->assignRole('customer');
        $customer = User::create([
            'name' => fake()->name(),
            'email' => 'b@g.c',
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('b'),
            'remember_token' => Str::random(10),
        ]);

        $customer->assignRole('customer');
        $customer = User::create([
            'name' => fake()->name(),
            'email' => 'c@g.c',
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('c'),
            'remember_token' => Str::random(10),
        ]);

        $customer->assignRole('customer');
        $customer = User::create([
            'name' => fake()->name(),
            'email' => 'd@g.c',
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('d'),
            'remember_token' => Str::random(10),
        ]);

        $customer->assignRole('customer');
        $customer = User::create([
            'name' => fake()->name(),
            'email' => 'e@g.c',
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('e'),
            'remember_token' => Str::random(10),
        ]);

        $customer->assignRole('customer');

        $admin = User::create([
            'name' => fake()->name(),
            'email' => 'x@g.c',
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('x'),
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole('admin');

        $cars = [
            [
                'name' => 'Ferrari 488 GTB',
                'type' => 'Supercar',
                'rental_price_per_day' => 15000000, // Harga sewa per hari dalam Rupiah
                'insurance_cost_per_day' => 2000000,  // Biaya asuransi per hari
                'service_fee_fixed' => 500000,     // Biaya layanan tetap per transaksi
                'description' => 'Feel the rush with Ferrari 488 GTB.',
                'license_plate' => 'B 1987 FGH',
                'image' => 'https://imgcdnblog.carbay.com/wp-content/uploads/2015/06/26075015/ferrari.jpg'
            ],
            [
                'name' => 'Lamborghini Huracán',
                'type' => 'Supercar',
                'rental_price_per_day' => 18000000,
                'insurance_cost_per_day' => 2500000,
                'service_fee_fixed' => 500000,
                'description' => 'Unleash power with Lamborghini Huracán.',
                'license_plate' => 'DK 4501 JI',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/2014-03-04_Geneva_Motor_Show_1375.JPG/500px-2014-03-04_Geneva_Motor_Show_1375.JPG'
            ],
            [
                'name' => 'McLaren 720S',
                'type' => 'Supercar',
                'rental_price_per_day' => 17000000,
                'insurance_cost_per_day' => 2300000,
                'service_fee_fixed' => 500000,
                'description' => 'Experience precision in a McLaren 720S.',
                'license_plate' => 'L 7777 AB',
                'image' => 'https://images.pexels.com/photos/27985144/pexels-photo-27985144.jpeg'
            ],
            [
                'name' => 'Porsche 911 Carrera',
                'type' => 'Sport Car',
                'rental_price_per_day' => 8000000,
                'insurance_cost_per_day' => 1000000,
                'service_fee_fixed' => 300000,
                'description' => 'Conquer the road in a Porsche 911 Carrera.',
                'license_plate' => 'D 2345 XZ',
                'image' => 'https://stimg.cardekho.com/images/carexteriorimages/630x420/Porsche/911/11757/1717680690776/front-left-side-47.jpg?imwidth=420&impolicy=resize'
            ],
            [
                'name' => 'Ford Mustang GT',
                'type' => 'Muscle Car',
                'rental_price_per_day' => 6000000,
                'insurance_cost_per_day' => 800000,
                'service_fee_fixed' => 300000,
                'description' => 'Dominate with the raw force of a Ford Mustang GT.',
                'license_plate' => 'AD 6789 CD',
                'image' => 'https://cdn.pixabay.com/photo/2017/05/23/20/06/mustang-2338351_1280.jpg'
            ],
            [
                'name' => 'Audi R8 V10',
                'type' => 'Supercar',
                'rental_price_per_day' => 14000000,
                'insurance_cost_per_day' => 1800000,
                'service_fee_fixed' => 500000,
                'description' => 'Embrace luxury performance with Audi R8 V10.',
                'license_plate' => 'AA 1010 XY',
                'image' => 'https://cdn.motor1.com/images/mgl/xqZoAk/s1/2023-audi-r8-v10-gt-rwd.jpg'
            ],
            [
                'name' => 'Nissan GT-R',
                'type' => 'Sport Car',
                'rental_price_per_day' => 9000000,
                'insurance_cost_per_day' => 1200000,
                'service_fee_fixed' => 300000,
                'description' => 'Ignite your drive in a Nissan GT-R.',
                'license_plate' => 'AB 2024 MN',
                'image' => 'https://momobil.id/news/wp-content/uploads/2023/06/Nissan-GT-R-R35.jpg'
            ],
            [
                'name' => 'Chevrolet Corvette C8',
                'type' => 'Sport Car',
                'rental_price_per_day' => 11000000,
                'insurance_cost_per_day' => 1500000,
                'service_fee_fixed' => 400000,
                'description' => 'Command attention with a Chevrolet Corvette C8.',
                'license_plate' => 'P 3000 EF',
                'image' => 'https://cdn.motor1.com/images/mgl/RqYArA/s1/2025-chevrolet-corvette-zr-1.jpg'
            ],
            [
                'name' => 'Mazda MX-5 Miata',
                'type' => 'Roadster',
                'rental_price_per_day' => 2500000,
                'insurance_cost_per_day' => 300000,
                'service_fee_fixed' => 150000,
                'description' => 'Pure driving joy in a Mazda MX-5 Miata.',
                'license_plate' => 'KT 5678 RS',
                'image' => 'https://mazdasultanagung.com/wp-content/uploads/2023/12/WhatsApp-Image-2023-12-19-at-16.13.26.jpeg'
            ],
            [
                'name' => 'Aston Martin Vantage',
                'type' => 'Sport Car',
                'rental_price_per_day' => 10000000,
                'insurance_cost_per_day' => 1300000,
                'service_fee_fixed' => 400000,
                'description' => 'Taste perfection with Aston Martin Vantage.',
                'license_plate' => 'Z 9090 OP',
                'image' => 'https://s.yimg.com/ny/api/res/1.2/.UmWKbEhEArGwlPPJhnhqw--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyNDI7aD02OTk-/https://media.zenfs.com/en/the_drive_634/630e263da89a7c8afc52dec43892c5e6'
            ]
        ];

        foreach ($cars as $car) {
            Cars::create([
                'name' => $car['name'],
                'type' => $car['type'],
                'description' => $car['description'],
                'plate_number' => $car['license_plate'],
                'rental_price' => $car['rental_price_per_day'],
                'insurance' => $car['insurance_cost_per_day'],
                'service_fee' => $car['service_fee_fixed'],
                'image' => $car['image']
            ]);
        }

        $this->call([
            // UsersSeeder::class,
            // CarsSeeder::class,
            PaymentMethodsSeeder::class,
            PaymentsSeeder::class,
            BookingsSeeder::class,
            // ReviewsSeeder::class,
        ]);
    }
}

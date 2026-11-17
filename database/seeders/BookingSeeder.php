<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * carga de las reservas iniciales de los usuarios
     */
    public function run(): void
    {
        //el precio de la cabalgata x persona ya se multiplica directamente x100
        
        DB::table('bookings')->insert([
            [
                'booking_id' => 1,
                'user_fk' => 2,
                'ride_fk' => 1,
                'ride_date' => '2026-10-24',
                'participants' => 2,
                'total_price' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'user_fk' => 2,
                'ride_fk' => 3,
                'ride_date' => '2026-11-28',
                'participants' => 1,
                'total_price' => 3500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 3,
                'user_fk' => 3,
                'ride_fk' => 2,
                'ride_date' => '2026-11-21',
                'participants' => 3,
                'total_price' => 13500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}

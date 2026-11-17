<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * ejecuta todos los seeders en orden
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RideSeeder::class,
            PostSeeder::class,
            BookingSeeder::class,
        ]);
    }
}

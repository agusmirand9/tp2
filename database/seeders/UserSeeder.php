<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * cargo un admin y dos usuarios comunes
     */
    public function run(): void
    {
        //hashea la contraseña una sola vez y se usa la misma en los demas usuarios
        $password = Hash::make('tp0123456');

        DB::table('users')->insert([
            [
                'id' => 1,
                'role_fk' => 2,
                'name' => 'Administradora',
                'email' => 'admin@test.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'role_fk' => 1,
                'name' => 'Martina Lopez',
                'email' => 'marlopez@test.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'role_fk' => 1,
                'name' => 'Mateo Perez',
                'email' => 'mateo@test.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);



    }
}

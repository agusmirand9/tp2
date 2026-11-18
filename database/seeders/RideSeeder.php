<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RideSeeder extends Seeder
{
    /**
     * cargo las cabalgatas que se ofrecen
     */
    public function run(): void
    {
        foreach (File::files(database_path('seeders/images/rides')) as $image) {
            Storage::disk('public')->put('covers/' . $image->getFilename(), File::get($image->getPathname()));
        }

        //precios x100
        DB::table('rides')->insert([
            [
                'ride_id' => 1,
                'name' => 'Cabalgata corta',
                'description' => 'Un paseo tranquilo por las calles del pueblo, ideal para quienes se suben a un caballo por primera vez. Incluye una breve explicación previa sobre cómo montar y guiar al caballo.',
                'duration_minutes' => 60,
                'price' => 2500000,
                'difficulty' => 'baja',
                'cover' => 'covers/cabalgata-corta.jpg',
                'cover_description' =>'Grupo de personas recorriendo a caballo un camino de tierra en el campo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ride_id' => 2,
                'name' => 'Cabalgata de medio día',
                'description' => 'Un recorrido más largo por el lago del campo, con una parada para descansar y disfrutar del paisaje. Recomendada para quienes ya montaron antes.',
                'duration_minutes' => 180,
                'price' => 4500000,
                'difficulty' => 'media',
                'cover' => 'covers/cabalgata-medio-dia.jpg',
                'cover_description' => 'Dos personas en caballo en el lago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ride_id' => 3,
                'name' => 'Cabalgata al atardecer',
                'description' => 'Una salida para ver caer el sol desde el campo, con tramos de trote suave. Se hace en grupos reducidos y vuelve al caer la noche.',
                'duration_minutes' => 120,
                'price' => 3500000,
                'difficulty' => 'media',
                'cover' => 'covers/cabalgata-atardecer.jpg',
                'cover_description' => 'Dos personas a caballo por el campo al atardecer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

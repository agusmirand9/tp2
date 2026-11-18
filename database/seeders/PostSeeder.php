<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PostSeeder extends Seeder
{
    /**
     * carga de los post del blog
     */
    public function run(): void
    {
        // copia las imagenes al disco publico
        foreach (File::files(database_path('seeders/images/posts')) as $image) {
            Storage::disk('public')->put('covers/' . $image->getFilename(), File::get($image->getPathname()));
        }

        DB::table('posts')->insert([
            [
                'post_id' => 1,
                'user_fk' => 1,
                'title' => 'Cómo prepararte para tu primera cabalgata',
                'slug' => 'como-prepararte-para-tu-primera-cabalgata',
                'excerpt' => 'Qué ropa llevar, qué esperar del paseo y cómo relajarte antes de subir al caballo.',
                'content' => 'Si nunca montaste, no te preocupes: los caballos que usamos para los paseos son mansos y están acostumbrados a los principiantes. Te recomendamos usar pantalón largo, zapatillas o botas y ropa cómoda. Antes de salir, un guía te explica cómo subir, cómo sostener las riendas y cómo indicarle al caballo que avance o frene.',
                'published_at' => '2026-10-05',
                'cover' => 'covers/preparar-primera-cabalgata.jpg',
                'cover_description' => 'Chica montando a caballo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'post_id' => 2,
                'user_fk' => 1,
                'title' => 'Las mejores épocas del año para cabalgar',
                'slug' => 'las-mejores-epocas-del-ano-para-cabalgar',
                'excerpt' => 'La primavera y el otoño son ideales, pero cada estación tiene su toque.',
                'content' => 'En primavera el campo está verde y las temperaturas son suaves. En otoño, los colores cambian y los atardeceres son larguísimos. El invierno es más frío, pero el aire es seco y se disfruta mucho. En verano conviene salir temprano o al atardecer, para evitar las horas de más calor.',
                'published_at' => '2026-10-19',
                'cover' => 'covers/mejores-epocas-cabalgar.jpg',
                'cover_description' => 'Grupo de personas cabalgando por el campo verde en primavera.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'post_id' => 3,
                'user_fk' => 1,
                'title' => 'Conocé a nuestros caballos',
                'slug' => 'conoce-a-nuestros-caballos',
                'excerpt' => 'Cada caballo tiene su carácter. Te contamos cómo los cuidamos y cómo elegimos el indicado para cada persona.',
                'content' => 'Cuidamos a nuestros caballos todos los días: buena alimentación, descanso y revisiones periódicas. Antes de cada paseo, el guía elige el caballo según tu experiencia y tu altura, para que te sientas seguro durante todo el recorrido.',
                'published_at' => '2026-11-02',
                'cover' => 'covers/nuestros-caballos.jpg',
                'cover_description' => 'Caballos descansando en el corral de la estancia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

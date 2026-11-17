<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser un email válido.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha igual o posterior a :date.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'unique' => 'El valor de :attribute ya está en uso.',
    'image' => 'El campo :attribute debe ser una imagen.',
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'uploaded' => 'No se pudo subir el archivo de :attribute.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'string' => 'El campo :attribute no puede superar los :max caracteres.',
        'file' => 'El campo :attribute no puede pesar más de :max KB.',
    ],

    /*
     * Nombres en español de los campos para usar en los mensajes
     */
    'attributes' => [
        'name' => 'nombre',
        'email' => 'email',
        'password' => 'contraseña',
        'title' => 'título',
        'excerpt' => 'resumen',
        'content' => 'contenido',
        'published_at' => 'fecha de publicación',
        'cover' => 'imagen de portada',
        'cover_description' => 'descripción de la imagen',
    ],
];

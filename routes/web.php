<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RideController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Support\Facades\Route;


// Sitio público

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{slug}', [BlogController::class, 'show'])
    ->name('blog.show');

Route::get('/cabalgatas', [RideController::class, 'index'])
    ->name('rides.index');

Route::get('/cabalgatas/{ride}', [RideController::class, 'show'])
    ->whereNumber('ride')
    ->name('rides.show');

//Autenticación

Route::get('/ingresar', [AuthController::class, 'loginForm'])
    ->middleware('guest')
    ->name('auth.login.form');

Route::post('/ingresar', [AuthController::class, 'loginProcess'])
    ->middleware('guest')
    ->name('auth.login.process');

Route::get('/registrarse', [RegisterController::class, 'form'])
    ->middleware('guest')
    ->name('auth.register.form');

Route::post('/registrarse', [RegisterController::class, 'process'])
    ->middleware('guest')
    ->name('auth.register.process');

Route::post('/cerrar-sesion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');


//Panel de admin
Route::middleware(['auth', EnsureIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/usuarios', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/usuarios/{user}', [UserController::class, 'show'])
            ->whereNumber('user')
            ->name('users.show');

        Route::get('/novedades', [PostController::class, 'index'])
            ->name('posts.index');

        Route::get('/novedades/crear', [PostController::class, 'create'])
            ->name('posts.create');

        Route::post('/novedades', [PostController::class, 'store'])
            ->name('posts.store');

        Route::get('/novedades/{post}/editar', [PostController::class, 'edit'])
            ->whereNumber('post')
            ->name('posts.edit');

        Route::post('/novedades/{post}/editar', [PostController::class, 'update'])
            ->whereNumber('post')
            ->name('posts.update');

        Route::get('/novedades/{post}/eliminar', [PostController::class, 'delete'])
            ->whereNumber('post')
            ->name('posts.delete');

        Route::post('/novedades/{post}/eliminar', [PostController::class, 'destroy'])
            ->whereNumber('post')
            ->name('posts.destroy');
    });

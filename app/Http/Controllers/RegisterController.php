<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * maneja el registro de nuevos usuarios
 */
class RegisterController extends Controller
{
    /**
     * muestra el form de registro
     * @return View
     */
    public function form(): View
    {
        return view('auth.register');
    }

    /**
     * valida los datos, crea el usuario e inicia su sesion
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function process(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'El campo nombre no puede quedar vacío.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'name.max' => 'El nombre no puede superar los :max caracteres.',
            'email.required' => 'El campo email no puede quedar vacío.',
            'email.email' => 'El email ingresado no tiene un formato válido.',
            'email.max' => 'El email no puede superar los :max caracteres.',
            'email.unique' => 'Ya existe una cuenta con ese email.',
            'password.required' => 'El campo contraseña no puede quedar vacío.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',

        ]);

        $user = new User($request->only(['name', 'email', 'password']));
        $user->role_fk = Role::where('name', 'user')->firstOrFail()->role_id;
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('feedback.message', 'Cuenta creada con éxito.');

    }
}

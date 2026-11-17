<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * maneja el inicio y cierre de sesion
 */

class AuthController extends Controller
{
    /**
     * muestra el form de inicio de sesion
     * @return View
     */
    public function loginForm(): View
    {
        return view('auth.login');
    }

    /**
     * valida las credenciales e inicia sesion de ese usuario
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function loginProcess(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El campo email no puede quedar vacío.',
            'email.email' => 'El email ingresado no tiene un formato válido.',
            'password.required' => 'El campo contraseña no puede quedar vacío.',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)){
            return redirect()
                ->route('auth.login.form')
                ->withErrors(['email' => 'Las credenciales ingresadas no coinciden con nuestros registros.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('feedback.message', 'Sesión iniciada con éxito. ¡Bienvenido!');
    }

        /**
         * cierra la sesion del usuario
         * @param Request $request
         * @return RedirectResponse
         */
        public function logout(Request $request): RedirectResponse
        {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('auth.login.form')
            ->with('feedback.message', 'Sesión cerrada con éxito. ¡Te esperamos de vuelta!');
        }

}

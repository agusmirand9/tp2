<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

/**
 * maneja la lista de usuarios en el panel de admin
 */
class UserController extends Controller
{
    /**
     * muestra el listado paginado de los usuarios
     * @return View
     */

    public function index(): View
    {
        $users = User::with('role')
            ->withCount('bookings')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * muestra el detalle del usuario con sus reservas
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $user->load('role');

        $bookings = $user->bookings()
            ->with('ride')
            ->orderBy('ride_date', 'desc')
            ->get();

        return view('admin.users.show', [
            'user' => $user,
            'bookings' => $bookings,
        ]);
    }
}

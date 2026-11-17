<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

/**
 * maneja el panel de inicio del admin
 */

class DashboardController extends Controller
{
    /**
     * muestra el panel con los acceso a las secciones del admin
     * @return View
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}

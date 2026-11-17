<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Contracts\View\View;

/**
 * maneja las paginas publicadas de las cabalgatas
 */

class RideController extends Controller
{
    /**
     * muestra el listado de las cabalgatas, de la mas barata a la mas cara
     * @return View
     */
    public function index(): View
    {
        $rides = Ride::orderBy('price')->get();

        return view('rides.index', [
            'rides' => $rides,
        ]);
    }

    /**
     * muestra el detalle de una cabalgata
     * @param  Ride  $ride
     * @return View
     */

    public function show(Ride $ride): View
    {
        return view('rides.show', [
            'ride' => $ride,
        ]);
    }
}

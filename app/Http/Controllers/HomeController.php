<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Ride;
use Illuminate\Contracts\View\View;

/**
 * maneja la pagina de inicio
 */

class HomeController extends Controller
{
    /**
     * muestra la pagina de inicio con los ultimos post publicados y cabalgatas
     * @return View
     */
    public function index(): View
    {
        $rides = Ride::orderBy('price')
            ->limit(3)
            ->get();

        $posts = Post::published()
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('home', [
            'rides' => $rides,
            'posts' => $posts,
        ]);
    }
}

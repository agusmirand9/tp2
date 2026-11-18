<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

/**
 * maneja las paginas del blog
 */
class BlogController extends Controller
{
    /**
     * muestra el listado paginado de posts publicados, del mas nuevo al viejo
     * @return View
     */
    public function index(): View
    {
        $posts = Post::published()
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('blog.index', [
            'posts' => $posts,
        ]);

    }

    /**
     * muestra el detalle del post, buscada por su slug, si no existe o no esta publicada todavia responde con un 404
     * @param  string  $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $post = Post::published()
            ->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('blog.show', [
            'post' => $post,

        ]);
    }
}

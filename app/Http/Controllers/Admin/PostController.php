<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


/**
 * maneja el abm de las novedades del blog en el admin
 */
class PostController extends Controller
{
    /**
     * muestra la lista de todas las novedades
     * @return View
     */
    public function index(): View
    {
        $posts = Post::with('author')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * muestra el form para crear una novedad
     * @return View
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * valida los datos, si hay guarda la imagen y crea la novedad con el usuario
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $data['slug'] = Post::uniqueSlugFor($data['title']);
        $data['cover'] = $request->file('cover')?->store('covers');

        $request->user()->posts()->create($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('feedback.message', 'La novedad "' . $data['title'] . '" se creó con éxito.');
    }


    /**
     * muestra el form para editar una novedad
     * @param  Post  $post
     * @return View
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * valida los datos y actualiza, reemplaza la img si subio una nueva
     * @param  Request  $request
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validatedData($request, $post);
        $oldCover = $post->cover;

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers');
        } else {
            unset($data['cover']);
        }

        $post->update($data);

        // La imagen anterior se borra cuando la novedad ya se actualiza
        if ($oldCover !== null && isset($data['cover'])) {
            Storage::delete($oldCover);
        }

        return redirect()
            ->route('admin.posts.index')
            ->with('feedback.message', 'La novedad "' . $post->title . '" se actualizó con éxito.');
    }

    /**
     * muestra la pantalla de confirmar eliminar
     * @param  Post  $post
     * @return View
     */
    public function delete(Post $post): View
    {
        return view('admin.posts.delete', [
            'post' => $post,
        ]);
    }

    /**
     * elimina la novedad y si tiene la imagen tambien
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        try {
            $post->delete();

            if ($post->cover !== null && Storage::exists($post->cover)) {
                Storage::delete($post->cover);
            }

            return redirect()
                ->route('admin.posts.index')
                ->with('feedback.message', 'La novedad "' . $post->title . '" se eliminó con éxito.');
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.posts.index')
                ->with('feedback.message', 'Ocurrió un error inesperado y la novedad "' . $post->title . '" no pudo ser eliminada.');
        }
    }

    /**
     * valida los datos del form de novedades, al editar y crear
     * @param  Request  $request
     * @param  Post|null  $post  la novedad que se edita, null al crear
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Post $post = null): array
    {
        // al editar se controla si el usuario cambio la fecha
        $dateChanged = $post === null
            || $request->input('published_at') !== $post->published_at->toDateString();

        return $request->validate([
            'title' => 'required|min:3|max:120',
            'excerpt' => 'required|min:10|max:255',
            'content' => 'required|min:20',
            'published_at' => [
                'required',
                'date',
                Rule::when($dateChanged, 'after_or_equal:today'),
            ],
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_description' => [
                'nullable',
                'max:255',
                'required_with:cover',
                Rule::requiredIf($post?->cover !== null),
            ],
        ], [
            'title.required' => 'El título no puede quedar vacío.',
            'title.min' => 'El título debe tener al menos :min caracteres.',
            'title.max' => 'El título no puede superar los :max caracteres.',
            'excerpt.required' => 'El resumen no puede quedar vacío.',
            'excerpt.min' => 'El resumen debe tener al menos :min caracteres.',
            'excerpt.max' => 'El resumen no puede superar los :max caracteres.',
            'content.required' => 'El contenido no puede quedar vacío.',
            'content.min' => 'El contenido debe tener al menos :min caracteres.',
            'published_at.required' => 'La fecha de publicación no puede quedar vacía.',
            'published_at.date' => 'La fecha de publicación no tiene un formato válido.',
            'published_at.after_or_equal' => 'La fecha de publicación no puede ser anterior a hoy.',
            'cover.image' => 'El archivo elegido tiene que ser una imagen.',
            'cover.mimes' => 'La imagen tiene que ser JPG, PNG o WEBP.',
            'cover.max' => 'La imagen no puede pesar más de 2 MB.',
            'cover.uploaded' => 'No se pudo subir la imagen. Probá con una de menos de 2 MB.',
            'cover_description.required' => 'La descripción de la imagen no puede quedar vacía.',
            'cover_description.required_with' => 'Si subís una imagen, tenés que describirla.',
            'cover_description.max' => 'La descripción no puede superar los :max caracteres.',
        ]);

    }
}

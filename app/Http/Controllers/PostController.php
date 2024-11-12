<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Exibir todos os posts
    public function index()
    {
        $posts = Post::with('tags')->get(); // Carregar posts com as tags associadas
        return response()->json($posts);
    }

    // Exibir um post específico
    public function show($id)
    {
        $post = Post::with('tags')->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    // Criar um novo post
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'array', // Campo de tags
        ]);

        // Criando o post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
        ]);

        // Associando tags ao post, se houver
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags); // Adicionando tags ao post
        }

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Atualizando o post
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Atualizando as tags do post, se houver
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags); // Sincroniza as tags, removendo as antigas e adicionando as novas
        }

        return response()->json($post);
    }

    // Excluir um post
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->tags()->detach();  // Desassociar as tags do post antes de excluir
        $post->delete();

        return response()->noContent(); 
    }

    // Excluir uma tag de todos os posts associados
    public function removeTagFromPosts($tagId)
    {
        $tag = Tag::find($tagId);

        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }

        // Remover a tag de todos os posts associados
        $tag->posts()->detach();

        return response()->json(['message' => 'Tag removed from all posts']);
    }
}

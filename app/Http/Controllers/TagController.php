<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // Exibir todas as tags
    public function index()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    // Exibir uma tag específica
    public function show($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json(['message' => 'Tag não encontrada'], 404);
        }

        return response()->json($tag);
    }

    // Criar uma nova tag
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        $tag = Tag::create([
            'name' => $request->name,
        ]);

        return response()->json($tag, 201);
    }

    // Atualizar uma tag existente
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json(['message' => 'Tag não encontrada'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->update([
            'name' => $request->name,
        ]);

        return response()->json($tag);
    }

    // Excluir uma tag
    public function destroy($id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json(['message' => 'Tag não encontrada'], 404);
        }

        // Remover a tag dos posts relacionados (se houver)
        // Supondo que você tenha uma relação muitos-para-muitos com posts
        $tag->posts()->detach(); // Desvincula todos os posts relacionados a essa tag

        // Excluir a tag
        $tag->delete();

        return response()->noContent(); 
    }
}

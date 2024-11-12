<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\Widget;

class PostsListWidget extends Widget
{
    protected static string $view = 'filament.widgets.posts-list-widget';

    protected static ?int $height = 400;

    // Define os dados que serão passados para a view
    protected function getViewData(): array
    {
        // Aqui buscamos os posts com limite de 10 registros
        $posts = Post::with('user', 'tags')->latest()->take(10)->get();

        return ['posts' => $posts];
    }
}

<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-lg font-bold mb-4">Últimos Posts</h2>
    
    @if($posts->isEmpty())
        <p>Não há posts disponíveis.</p>
    @else
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Título</th>
                    <th class="px-4 py-2 text-left">Autor</th>
                    <th class="px-4 py-2 text-left">Tags</th>
                    <th class="px-4 py-2 text-left">Data de Criação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td class="border px-4 py-2">{{ $post->title }}</td>
                        <td class="border px-4 py-2">{{ $post->user->name }}</td>
                        <td class="border px-4 py-2">
                            @foreach($post->tags as $tag)
                                <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs font-semibold text-gray-700">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="border px-4 py-2">{{ $post->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

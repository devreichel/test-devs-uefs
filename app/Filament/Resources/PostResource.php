<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Textarea::make('content')
                    ->required(),

                // Campo oculto para user_id
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->id()) // Valor padrão será o ID do usuário autenticado
                    ->label('User ID'),

                // Campo para selecionar múltiplas tags
                Forms\Components\Select::make('tags')
                    ->relationship('tags', 'name') // Relacionamento entre Post e Tag
                    ->multiple()
                    ->preload() // Precarregar as tags
                    ->label('Tags'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.name')->sortable(), // Exibe o nome do usuário relacionado
                Tables\Columns\TextColumn::make('created_at')->dateTime('Y-m-d H:i')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime('Y-m-d H:i')->sortable(),
            ])
            ->filters([
                // Filtros adicionais, se necessário
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

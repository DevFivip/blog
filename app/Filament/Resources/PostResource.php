<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Set;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 2,
                    '2xl' => 3,
                ])
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('title')->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))->required(),
                                TextInput::make('slug')->required(),

                                RichEditor::make('content')
                                    ->fileAttachmentsDisk('public')
                                    ->required()
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ]),
                                Textarea::make('meta_description')
                                    ->rows(3)
                                    ->cols(20)
                            ])->columnSpan(2),
                        Grid::make([
                            'default' => 2,
                            '2xl' => 1,
                        ])
                            ->schema([
                                Section::make()
                                    ->schema([
                                        FileUpload::make('featured_image')
                                            ->label('Imagen destacada')
                                            ->disk('public')
                                            ->image()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ]),
                                    ]),
                                Section::make('')
                                    ->schema([
                                        Select::make('author_id')->label('Author')
                                            ->options(User::get()->pluck('name', 'id'))
                                            ->searchable()
                                            ->native(false)->required(),
                                        DateTimePicker::make('publish_date')->label('Fecha de Publicación')->native(false)->required(),
                                        Select::make('status')
                                            ->label('Status')
                                            ->options([
                                                'draft' => 'Borrador',
                                                'pending' => 'Pendiente',
                                                'published' => 'Publicado',
                                            ])
                                            ->native(false)
                                            ->required(),
                                    ]),
                                Section::make('')
                                    ->schema([
                                        Select::make('tags')
                                            ->multiple()
                                            ->relationship(titleAttribute: 'name')
                                            ->createOptionForm(fn (Form $form) => TagResource::form($form))
                                            ->native(false)
                                            ->required(),
                                        Select::make('categories')
                                            ->multiple()
                                            ->relationship(titleAttribute: 'name')
                                            ->createOptionForm(fn (Form $form) => CategoryResource::form($form))
                                            ->native(false)
                                            ->required(),
                                    ]),
                            ])->columnSpan(1),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->disk('public')
                    ->square()
                    ->height(50)
                    ->extraImgAttributes(['loading' => 'lazy']),
                TextColumn::make('title')->wrap(),
                TextColumn::make('author.name')->wrap(),
                TextColumn::make('categories.name')->wrap(),
                TextColumn::make('tags.name')->wrap(),
                TextColumn::make('views')->wrap(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionHeroResource\Pages;
use App\Filament\Resources\SectionHeroResource\RelationManagers;
use App\Models\SectionHero;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionHeroResource extends Resource
{
    protected static ?string $model = SectionHero::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Landing Sections';

    protected static ?string $navigationLabel = 'Hero';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    '2xl' => 1,
                ])
                    ->schema([
                        Section::make()
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->imageEditor()
                                    ->preserveFilenames()
                                    ->openable()
                            ]),
                        Section::make('')
                            ->schema([
                                TextInput::make('position')->numeric()->required(),
                                TextInput::make('title')->required(),
                                RichEditor::make('content')
                                    ->required()
                                    ->toolbarButtons([
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
                                    ])
                            ]),
                        Section::make()
                            ->schema([
                                TextInput::make('action_button_title')->required(),
                                TextInput::make('action_button_link')->required(),
                                TextInput::make('secondary_button_title')->required(),
                                TextInput::make('secondary_button_link')->required(),
                            ]),
                    ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->conversion('thumb'),
                TextColumn::make('title')
                    ->description(fn (SectionHero $record): string => strip_tags($record->content))
                    ->wrap(),
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
            'index' => Pages\ListSectionHeroes::route('/'),
            'create' => Pages\CreateSectionHero::route('/create'),
            'edit' => Pages\EditSectionHero::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionFaqResource\Pages;
use App\Filament\Resources\SectionFaqResource\RelationManagers;
use App\Models\SectionFaq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;

class SectionFaqResource extends Resource
{
    protected static ?string $model = SectionFaq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Landing Sections';

    protected static ?string $navigationLabel = 'FAQ';

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
                                TextInput::make('question')->label('Pregunta')->required(),
                                Textarea::make('answer')->label('Respuesta')->required(),
                            ]),
                    ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')
                    ->description(fn (SectionFaq $record): string => strip_tags($record->answer))
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
            'index' => Pages\ListSectionFaqs::route('/'),
            'create' => Pages\CreateSectionFaq::route('/create'),
            'edit' => Pages\EditSectionFaq::route('/{record}/edit'),
        ];
    }
}

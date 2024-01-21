<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionCustomerResource\Pages;
use App\Filament\Resources\SectionCustomerResource\RelationManagers;
use App\Models\SectionCustomer;
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

class SectionCustomerResource extends Resource
{
    protected static ?string $model = SectionCustomer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Landing Sections';

    protected static ?string $navigationLabel = 'Customers';

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
                                TextInput::make('label')->required(),
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
                    ->conversion('thumb')->wrap(),
                TextColumn::make('title')
                    ->description(fn (SectionCustomer $record): string => strip_tags($record->content))
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
            ])
            ->defaultSort('position')
            ->reorderable('position');
            ;
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
            'index' => Pages\ListSectionCustomers::route('/'),
            'create' => Pages\CreateSectionCustomer::route('/create'),
            'edit' => Pages\EditSectionCustomer::route('/{record}/edit'),
        ];
    }
}

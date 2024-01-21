<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinksResource\Pages;
use App\Filament\Resources\SocialLinksResource\RelationManagers;
use App\Models\SocialLink;
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

class SocialLinksResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Landing Sections';

    protected static ?string $navigationLabel = 'Social Links';

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
                                TextInput::make('red_social')->label('Red Social')->helperText('Ejemplo Instagram, Facebook, WhastApp')->required(),
                                TextInput::make('red_social_username')->label('Link de tu red social')->helperText('Ejemplo https://instagram.com/example')->required(),
                                TextInput::make('icon_blade_ui')->label('Icono')->helperText('Icono de la libreria blade-ui-kit.com/blade-icons')->required(),
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
                TextColumn::make('red_social')
                    ->description(fn (SocialLink $record): string => ($record->red_social_username))
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
            'index' => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLinks::route('/create'),
            'edit' => Pages\EditSocialLinks::route('/{record}/edit'),
        ];
    }
}

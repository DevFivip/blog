<?php

namespace App\Filament\Resources\SectionHeroResource\Pages;

use App\Filament\Resources\SectionHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSectionHeroes extends ListRecords
{
    protected static string $resource = SectionHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

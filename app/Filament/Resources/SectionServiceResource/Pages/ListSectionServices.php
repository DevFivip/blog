<?php

namespace App\Filament\Resources\SectionServiceResource\Pages;

use App\Filament\Resources\SectionServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSectionServices extends ListRecords
{
    protected static string $resource = SectionServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

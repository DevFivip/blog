<?php

namespace App\Filament\Resources\SectionServiceResource\Pages;

use App\Filament\Resources\SectionServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSectionService extends EditRecord
{
    protected static string $resource = SectionServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

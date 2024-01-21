<?php

namespace App\Filament\Resources\SectionHeroResource\Pages;

use App\Filament\Resources\SectionHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSectionHero extends EditRecord
{
    protected static string $resource = SectionHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

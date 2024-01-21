<?php

namespace App\Filament\Resources\SectionFaqResource\Pages;

use App\Filament\Resources\SectionFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSectionFaq extends EditRecord
{
    protected static string $resource = SectionFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

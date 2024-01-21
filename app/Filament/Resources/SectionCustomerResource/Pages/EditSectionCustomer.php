<?php

namespace App\Filament\Resources\SectionCustomerResource\Pages;

use App\Filament\Resources\SectionCustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSectionCustomer extends EditRecord
{
    protected static string $resource = SectionCustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

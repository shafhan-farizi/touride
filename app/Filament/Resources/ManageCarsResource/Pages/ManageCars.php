<?php

namespace App\Filament\Resources\ManageCarsResource\Pages;

use App\Filament\Resources\ManageCarsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCars extends ManageRecords
{
    protected static string $resource = ManageCarsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\TransportationResource\Pages;

use App\Filament\Resources\TransportationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransportation extends EditRecord
{
    protected static string $resource = TransportationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\CoachResource\Pages;

use App\Filament\Resources\CoachResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoach extends EditRecord
{
    protected static string $resource = CoachResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

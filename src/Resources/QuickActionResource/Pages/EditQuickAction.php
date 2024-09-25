<?php

namespace IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource\Pages;

use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuickAction extends EditRecord
{
    protected static string $resource = QuickActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

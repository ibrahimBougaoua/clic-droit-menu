<?php

namespace IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource;

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

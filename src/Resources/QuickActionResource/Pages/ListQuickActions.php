<?php

namespace IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource\Pages;

use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuickActions extends ListRecords
{
    protected static string $resource = QuickActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('manage')
            ->label(__('Manage'))
            ->icon('heroicon-o-cog')
            ->color('success')
            ->url(fn (): string => route('filament.admin.resources.quick-actions.quick-action-setting')),
            Actions\CreateAction::make(),
        ];
    }
}

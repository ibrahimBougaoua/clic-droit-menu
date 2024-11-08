<?php

namespace IbrahimBougaoua\ClicDroitMenu;

use Filament\Support\Facades\FilamentView;
use Filament\Tables\View\TablesRenderHook;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class ClicDroitMenu
{
    public function __construct()
    {
        $this->registerQuickActionButtonComponent();
        $this->registerFooterComponent();
    }

    public function registerQuickActionButtonComponent()
    {
        if (class_exists(\IbrahimBougaoua\ClicDroitMenu\Livewire\QuickActionComponent::class)) {
            Livewire::component('quick-action-component', \IbrahimBougaoua\ClicDroitMenu\Livewire\QuickActionComponent::class);
        }

        FilamentView::registerRenderHook(
            TablesRenderHook::TOOLBAR_END,
            fn (): string => Blade::render('@livewire(\'quick-action-component\')'),
        );
    }

    public function registerFooterComponent()
    {
        if (class_exists(\IbrahimBougaoua\ClicDroitMenu\Livewire\QuickActionFooterComponent::class)) {
            Livewire::component('quick-action-footer-component', \IbrahimBougaoua\ClicDroitMenu\Livewire\QuickActionFooterComponent::class);
        }

        FilamentView::registerRenderHook(
            PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE,
            fn (): string => Blade::render('@livewire(\'quick-action-footer-component\')'),
        );
    }
}

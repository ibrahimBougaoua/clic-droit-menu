<?php

namespace IbrahimBougaoua\ClicDroitMenu;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource;
use Illuminate\Support\Facades\Blade;

class ClicDroitMenuPlugin implements Plugin
{
    public function getId(): string
    {
        return 'clic-droit-menu';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                QuickActionResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        // Define the menu structure with Filament icons (Heroicons)
        $content_menus = [
            [
                'label' => 'Content',
                'url' => '/content',
                'icon' => 'heroicon-o-cog',
                'badge' => [
                    'text' => 'New',
                    'color' => 'bg-red-500 text-white', // Red badge with white text
                ],
                'submenu' => [],
            ],
            [
                'label' => 'Dashboard',
                'url' => '/dashboard',
                'icon' => 'heroicon-o-cog',
                'badge' => [
                    'text' => 'New',
                    'color' => 'bg-red-500 text-white', // Red badge with white text
                ],
                'submenu' => [],
            ],
            [
                'label' => 'Settings',
                'url' => '/settings',
                'icon' => 'heroicon-s-chevron-down',
                'badge' => [
                    'text' => '4',
                    'color' => 'bg-blue-500 text-white', // Blue badge with white text
                ],
                'submenu' => [
                    [
                        'label' => 'Account Settings',
                        'url' => '/settings/account',
                        'icon' => 'heroicon-o-cog',
                    ],
                ],
            ],
            [
                'label' => 'Settings',
                'url' => '/settings',
                'icon' => 'heroicon-s-chevron-down',
                'badge' => [
                    'text' => '4',
                    'color' => 'bg-blue-500 text-white', // Blue badge with white text
                ],
                'submenu' => [
                    [
                        'label' => 'Account Settings',
                        'url' => '/settings/account',
                        'icon' => 'heroicon-o-cog',
                    ],
                    [
                        'label' => 'Account Settings',
                        'url' => '/settings/account',
                        'icon' => 'heroicon-o-cog',
                    ],
                ],
            ],
            [
                'label' => 'Settings',
                'url' => '/settings',
                'icon' => 'heroicon-s-chevron-down',
                'badge' => [
                    'text' => '4',
                    'color' => 'bg-blue-500 text-white', // Blue badge with white text
                ],
                'submenu' => [
                    [
                        'label' => 'Account Settings',
                        'url' => '/settings/account',
                        'icon' => 'heroicon-o-cog',
                    ],
                    [
                        'label' => 'Account Settings',
                        'url' => '/settings/account',
                        'icon' => 'heroicon-o-cog',
                    ],
                    [
                        'label' => 'Account Settings',
                        'url' => '/settings/account',
                        'icon' => 'heroicon-o-cog',
                    ],
                ],
            ],
        ];        
        
        // Register the hook with menu data passed dynamically
        FilamentView::registerRenderHook(
            PanelsRenderHook::CONTENT_END,
            fn (): string => Blade::render(
                '@livewire("quick-action-component", ["menus" => $content_menus])', 
                ['content_menus' => $content_menus]
            )
        );
        
        FilamentView::registerRenderHook(
            PanelsRenderHook::CONTENT_END,
            fn (): string => Blade::render(
                '@livewire("quick-action-footer-component")'
            )
        );
    }
}

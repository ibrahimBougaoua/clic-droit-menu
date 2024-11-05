<?php

namespace IbrahimBougaoua\ClicDroitMenu;

use Filament\Contracts\Plugin;
use Filament\Panel;
use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource;

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
        app(ClicDroitMenu::class);
    }
}

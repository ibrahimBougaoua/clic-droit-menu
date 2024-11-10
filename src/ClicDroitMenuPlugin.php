<?php

namespace IbrahimBougaoua\ClicDroitMenu;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource;

class ClicDroitMenuPlugin implements Plugin
{
    use EvaluatesClosures;

    protected ?string $resource = null;

    protected string|Closure|null $label = null;

    protected Closure|bool $navigationItem = true;

    protected string|Closure|null $navigationGroup = null;

    protected ?string $navigationIcon = null;

    protected ?int $navigationSort = null;

    protected ?bool $navigationCountBadge = null;

    protected string|Closure|null $pluralLabel = null;

    protected bool|Closure $authorizeUsing = true;

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

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }

    public function navigationIcon(string $icon): static
    {
        $this->navigationIcon = $icon;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->evaluate($this->label) ?? config('filament-activitylog.resources.label');
    }

    public function getPluralLabel(): string
    {
        return $this->evaluate($this->pluralLabel) ?? config('clic-droit-menu.resources.plural_label');
    }

    public function getNavigationGroup(): ?string
    {
        return $this->evaluate($this->navigationGroup) ?? config('clic-droit-menu.resources.navigation_group');
    }

    public function getNavigationIcon(): ?string
    {
        return $this->navigationIcon ?? config('clic-droit-menu.resources.navigation_icon');
    }
}

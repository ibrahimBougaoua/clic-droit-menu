<?php

namespace IbrahimBougaoua\ClicDroitMenu;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use IbrahimBougaoua\ClicDroitMenu\Commands\ClicDroitMenuCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ClicDroitMenuServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('clic-droit-menu')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_clic_droit_menu_table')
            ->hasCommand(ClicDroitMenuCommand::class);
    }

    public function packageBooted(): void
    {
        $this->loadAssets();
        //app(ClicDroitMenu::class);
    }

    public function loadAssets()
    {
        FilamentAsset::register(
            [
                Css::make('clic-droit-menu-styles', __DIR__.'/../resources/css/custom.css'),
            ],
            package: 'ibrahimbougaoua/clic-droit-menu'
        );
    }
}

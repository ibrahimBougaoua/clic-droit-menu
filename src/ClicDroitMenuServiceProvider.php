<?php

namespace IbrahimBougaoua\ClicDroitMenu;

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
}

<?php

namespace Emaia\D4sign;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Emaia\D4sign\Commands\D4signCommand;

class D4signServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-d4sign')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-d4sign_table')
            ->hasCommand(D4signCommand::class);
    }
}

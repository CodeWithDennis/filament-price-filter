<?php

namespace CodeWithDennis\FilamentPriceFilter;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPriceFilterServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-price-filter';

    public static string $viewNamespace = 'filament-price-filter';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('codewithdennis/filament-price-filter');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        //
    }

    protected function getAssetPackageName(): ?string
    {
        return 'codewithdennis/filament-price-filter';
    }

    protected function getAssets(): array
    {
        return [];
    }

    protected function getCommands(): array
    {
        return [];
    }

    protected function getIcons(): array
    {
        return [];
    }

    protected function getRoutes(): array
    {
        return [];
    }

    protected function getScriptData(): array
    {
        return [];
    }
}

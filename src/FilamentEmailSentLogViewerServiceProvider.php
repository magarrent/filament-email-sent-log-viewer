<?php

namespace Magarrent\FilamentEmailSentLogViewer;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Magarrent\FilamentEmailSentLogViewer\Commands\FilamentEmailSentLogViewerCommand;
use Magarrent\FilamentEmailSentLogViewer\Testing\TestsFilamentEmailSentLogViewer;

class FilamentEmailSentLogViewerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-email-sent-log-viewer';

    public static string $viewNamespace = 'filament-email-sent-log-viewer';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->publishesServiceProvider('FilamentEmailSentLogViewerServiceProvider')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('magarrent/filament-email-sent-log-viewer')
                    ->endWith(function(InstallCommand $command) {
                        $command->info('All set! 🚀');
                        $command->info('Your emails will now be logged automatically. You can access via the admin panel now.');
                    });
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
            $package->runsMigrations();
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
        $this->app->register(FilamentEmailSentLogViewerEventServiceProvider::class);
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-email-sent-log-viewer/{$file->getFilename()}"),
                ], 'filament-email-sent-log-viewer-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentEmailSentLogViewer());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'magarrent/filament-email-sent-log-viewer';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-email-sent-log-viewer', __DIR__ . '/../resources/dist/components/filament-email-sent-log-viewer.js'),
            /*Css::make('filament-email-sent-log-viewer-styles', __DIR__ . '/../resources/dist/filament-email-sent-log-viewer.css'),
            Js::make('filament-email-sent-log-viewer-scripts', __DIR__ . '/../resources/dist/filament-email-sent-log-viewer.js'),*/
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentEmailSentLogViewerCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_email_sent_log_viewer_table',
        ];
    }
}

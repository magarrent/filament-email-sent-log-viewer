<?php

namespace Magarrent\FilamentEmailSentLogViewer;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Magarrent\FilamentEmailSentLogViewer\Filament\Resources\EmailSentLogViewerResource;

class FilamentEmailSentLogViewerPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-email-sent-log-viewer';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            EmailSentLogViewerResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {

    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}

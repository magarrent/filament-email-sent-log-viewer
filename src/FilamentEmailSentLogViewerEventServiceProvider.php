<?php

namespace Magarrent\FilamentEmailSentLogViewer;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSent;
use Magarrent\FilamentEmailSentLogViewer\Listeners\FilamentEmailSentLogListener;

class FilamentEmailSentLogViewerEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessageSent::class => [
            FilamentEmailSentLogListener::class,
        ],
    ];
}

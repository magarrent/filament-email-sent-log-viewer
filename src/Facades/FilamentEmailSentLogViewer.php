<?php

namespace Magarrent\FilamentEmailSentLogViewer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Magarrent\FilamentEmailSentLogViewer\FilamentEmailSentLogViewer
 */
class FilamentEmailSentLogViewer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Magarrent\FilamentEmailSentLogViewer\FilamentEmailSentLogViewer::class;
    }
}

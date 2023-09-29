<?php

namespace Magarrent\FilamentEmailSentLogViewer\Filament\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Magarrent\FilamentEmailSentLogViewer\Filament\Resources\EmailSentLogViewerResource;

class CreateEmailSentLogViewer extends CreateRecord
{
    protected static string $resource = EmailSentLogViewerResource::class;
}

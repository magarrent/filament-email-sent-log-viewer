<?php

namespace Magarrent\FilamentEmailSentLogViewer\Filament\Resources\Pages;

use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Magarrent\FilamentEmailSentLogViewer\Filament\Resources\EmailSentLogViewerResource;

class EditEmailSentLogViewer extends EditRecord
{
    protected static string $resource = EmailSentLogViewerResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

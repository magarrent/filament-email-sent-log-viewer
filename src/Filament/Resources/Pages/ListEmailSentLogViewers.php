<?php

namespace Magarrent\FilamentEmailSentLogViewer\Filament\Resources\Pages;

use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Magarrent\FilamentEmailSentLogViewer\Filament\Resources\EmailSentLogViewerResource;

class ListEmailSentLogViewers extends ListRecords
{
    protected static string $resource = EmailSentLogViewerResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace Magarrent\FilamentEmailSentLogViewer\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists\Components\Card;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\HTMLToMarkdown\HtmlConverter;
use Magarrent\FilamentEmailSentLogViewer\Filament\Resources\Pages\ListEmailSentLogViewers;
use Magarrent\FilamentEmailSentLogViewer\Filament\Resources\Pages\ViewEmailSentLogViewer;
use Magarrent\FilamentEmailSentLogViewer\Models\EmailSentLog;


class EmailSentLogViewerResource extends Resource
{
    protected static ?string $model = EmailSentLog::class;

    protected static ?string $slug = 'email-sent-log-viewers';

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('sent_at')
                    ->dateTime(),
                TextColumn::make('from')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('to')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject')
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->filters([
                Filter::make('start_at')
                    ->form([
                        DatePicker::make('sent_from'),
                        DatePicker::make('sent_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['sent_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sent_at', '>=', $date),
                            )
                            ->when(
                                $data['sent_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('sent_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['sent_from'] ?? null) {
                            $indicators['sent_from'] = 'From ' . Carbon::parse($data['sent_from'])->toFormattedDateString();
                        }

                        if ($data['sent_until'] ?? null) {
                            $indicators['sent_until'] = 'Until ' . Carbon::parse($data['sent_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    })
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Card::make('info')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('from'),
                        TextEntry::make('to'),
                        TextEntry::make('subject'),
                        TextEntry::make('sent_at')
                        ->badge()
                        ->dateTime(),
                        TextEntry::make('cc')
                            ->hidden(fn (EmailSentLog $record): bool => ! $record->cc),
                        TextEntry::make('bcc')
                            ->hidden(fn (EmailSentLog $record): bool => ! $record->bcc),
                    ]),
                Tabs::make('Body')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Body')
                            ->schema([
                                TextEntry::make('body')
                                    ->formatStateUsing(function (EmailSentLog $record): string {
                                        return str($record->body)->sanitizeHtml();
                                    })
                            ]),
                        Tabs\Tab::make('Raw body')
                            ->schema([
                                TextEntry::make('body'),
                            ]),
                    ]),

                Card::make('Headers & Attachments')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('headers')
                            ->hidden(fn (EmailSentLog $record): bool => ! $record->headers),
                        TextEntry::make('attachments')
                            ->hidden(fn (EmailSentLog $record): bool => ! $record->attachments),
                    ]),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmailSentLogViewers::route('/'),
            'view' => ViewEmailSentLogViewer::route('/{record}/view'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}

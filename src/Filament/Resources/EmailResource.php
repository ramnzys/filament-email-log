<?php

namespace Ramnzys\FilamentEmailLog\Filament\Resources;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Ramnzys\FilamentEmailLog\Models\Email;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource\Pages\ListEmails;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource\Pages\ViewEmail;

class EmailResource extends Resource
{
    public static function getModel(): string
    {
        return config('filament-email-log.model.class') ?? Email::class;
    }

    public static function getModelLabel(): string
    {
        return config('filament-email-log.model.label') ?? parent::getModelLabel();
    }

    public static function getPluralModelLabel(): string
    {
        return config('filament-email-log.model.label_plural') ?? parent::getPluralModelLabel();
    }

    protected static function getNavigationIcon(): string
    {
        return config('filament-email-log.navigation.icon') ?? 'heroicon-o-collection';
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-email-log.navigation.group') ?? parent::getNavigationGroup();
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-email-log.navigation.sort') ?? parent::getNavigationSort();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Envelope')->label(__('Envelope'))->schema([
                    TextInput::make('created_at')->label(__('Created at')),
                    TextInput::make('from')->label(__('From')),
                    TextInput::make('to')->label(__('To')),
                    TextInput::make('cc')->label(__('Cc')),
                    TextInput::make('subject')->label(__('Subject'))->columnSpan(2),
                ])->columns(3),
                Tabs::make('Content')->tabs([
                    Tab::make('HTML')->label(__('HTML'))
                        ->schema([
                            ViewField::make('html_body')->disableLabel()
                                ->view('filament-email-log::HtmlEmailView'),
                        ]),
                    Tab::make('Text')->label(__('Text'))
                        ->schema([
                            Textarea::make('text_body')->disableLabel(),
                        ]),
                    Tab::make('Raw')->label(__('Raw'))
                        ->schema([
                            Textarea::make('raw_body')
                                ->extraAttributes(['class' => 'font-mono text-xs'])
                                ->disableLabel(),
                        ]),
                    Tab::make('Debug information')->label(__('Debug information'))
                        ->schema([
                            Textarea::make('sent_debug_info')
                                ->extraAttributes(['class' => 'font-mono text-xs'])
                                ->disableLabel(),
                        ]),
                ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label(__('Date and time sent'))
                    ->sortable(),
                TextColumn::make('from')
                    ->label(__('From'))
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('to')
                    ->label(__('To'))
                    ->searchable(),
                TextColumn::make('cc')
                    ->label(__('Cc'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('subject')
                    ->label(__('Subject'))
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }

                        return $state;
                    })
                    ->searchable(),
            ])
            ->bulkActions([])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmails::route('/'),
            'view' => ViewEmail::route('/{record}'),
        ];
    }
}

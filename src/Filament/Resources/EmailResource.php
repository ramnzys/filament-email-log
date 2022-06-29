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
use Illuminate\Support\Facades\Config;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource\Pages\ListEmails;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource\Pages\ViewEmail;
use Ramnzys\FilamentEmailLog\Models\Email;

class EmailResource extends Resource
{
    protected static ?string $model = Email::class;

    protected static ?string $navigationIcon = 'heroicon-o-mail';

    protected static function getNavigationGroup(): ?string
    {
        return Config::get('filament-email-log.resource.group') ?? parent::getNavigationGroup();
    }

    protected static function getNavigationSort(): ?int
    {
        return Config::get('filament-email-log.resource.sort') ?? parent::getNavigationSort();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Envelope')->schema([
                    TextInput::make('created_at'),
                    TextInput::make('from'),
                    TextInput::make('to'),
                    TextInput::make('cc'),
                    TextInput::make('subject')->columnSpan(2),
                ])->columns(3),
                Tabs::make('Content')->tabs([
                    Tab::make('HTML')
                        ->schema([
                            ViewField::make('html_body')->disableLabel()
                                ->view('filament-email-log::HtmlEmailView'),
                        ]),
                    Tab::make('Text')
                        ->schema([
                            Textarea::make('text_body')->disableLabel(),
                        ]),
                    Tab::make('Raw')
                        ->schema([
                            Textarea::make('raw_body')
                                ->extraAttributes(['class' => 'font-mono text-xs'])
                                ->disableLabel(),
                        ]),
                    Tab::make('Debug information')
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

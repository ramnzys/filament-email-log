<?php

// config for Ramnzys/FilamentEmailLog

return [

    'model' => [
        'class' => Ramnzys\FilamentEmailLog\Models\Email::class,
        'label' => null,
        'label_plural' => null,
    ],

    'navigation' => [
        'icon' => 'heroicon-o-mail',
        'group' => null,
        'sort' => null,
    ],

    'resources' => [
        'EmailResource' => Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource::class,
    ],

    /**
     * Define the numbers of days to keep the emails in the log database
     */
    'keep_email_for_days' => 90,

];

<?php

// config for Ramnzys/FilamentEmailLog
return [
    'resource_class' => \Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource::class,
    
    'resource' => [
        'group' => null,
        'sort' => null,
    ],

    /**
     * Define the numbers of days to keep the emails in the log database
     */
    'keep_email_for_days' => 90,

];

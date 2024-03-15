<?php

// config for Ramnzys/FilamentEmailLog
return [

    'resource' => [
        'group' => null,
        'sort' => null,
    ],

    /**
     * Define the numbers of days to keep the emails in the log database
     */
    'keep_email_for_days' => 90,


    /**
     * Define table column From to be hidden
     */
    'hidden_column_from' => false,

];

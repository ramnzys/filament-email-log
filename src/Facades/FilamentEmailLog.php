<?php

namespace Ramnzys\FilamentEmailLog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ramnzys\FilamentEmailLog\FilamentEmailLog
 */
class FilamentEmailLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filament-email-log';
    }
}

<?php

namespace Ramnzys\FilamentEmailLog\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'filament_email_log';

    public $guarded = [];
}

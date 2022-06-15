<?php

namespace Ramnzys\FilamentEmailLog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Email
 *
 * @property string $from
 * @property string $to
 * @property string $cc
 * @property string $bcc
 * @property string $subject
 * @property string $text_body
 * @property string $html_body
 *
 * @package Ramnzys\FilamentEmailLog\Models
 */
class Email extends Model
{
    protected $table = 'filament_email_log';

    public $guarded = [];
}

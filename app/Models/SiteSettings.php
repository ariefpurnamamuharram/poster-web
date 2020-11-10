<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;

    public const SETTING_SITE_TITLE = 'site_title';

    protected $table = 'site_settings';

    protected $fillable = [
        'key',
        'value',
    ];
}

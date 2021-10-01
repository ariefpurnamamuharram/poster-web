<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemVersion extends Model
{
    use HasFactory;

    public const RELEASE_VERSION = "0.0.3";

    public const RELEASE_DATE = "Oct 2021";
}

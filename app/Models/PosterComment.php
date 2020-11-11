<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterComment extends Model
{
    use HasFactory;

    protected $table = 'poster_comments';

    protected $fillable = [
        'poster_id',
        'name',
        'email',
        'comment',
    ];
}

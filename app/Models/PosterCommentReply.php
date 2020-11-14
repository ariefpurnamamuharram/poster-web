<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterCommentReply extends Model
{
    use HasFactory;

    protected $table = 'poster_comment_replies';

    protected $fillable = [
        'poster_id',
        'comment_id',
        'name',
        'email',
        'comment',
    ];
}

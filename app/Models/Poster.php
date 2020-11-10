<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $table = 'posters';

    protected $fillable = [
        'poster_title',
        'poster_authors',
        'author_affiliations',
        'poster_category',
        'poster_filename',
        'poster_abstract',
        'poster_keywords',
        'total_likes',
        'total_dislikes',
        'total_comments',
        'posted_by_id',
        'posted_by_name',
        'posted_by_email',
    ];
}

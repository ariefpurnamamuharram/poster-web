<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterVoteIP extends Model
{
    use HasFactory;

    protected $table = 'posters_vote_ips';

    protected $fillable = [
        'poster_id',
        'user_ip',
    ];
}

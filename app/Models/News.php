<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'teaser',
        'body',
        'source_url',
        'source_name',
        'published_at',
        'fetched_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'fetched_at'   => 'datetime',
    ];
}

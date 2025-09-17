<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'course_id',
        'video_link'
    ];

    // Specify that description can handle large text
    protected $casts = [
        'description' => 'string'
    ];
}

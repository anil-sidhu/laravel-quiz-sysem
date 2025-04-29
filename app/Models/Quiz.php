<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    function category(){
        return $this->belongsTo(Category::class);
    }

    function Mcq(){
        return $this->hasMany(Mcq::class);
    }

    function Records(){
        return $this->hasMany(Record::class);
    }

}

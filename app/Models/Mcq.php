<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    //
    
    function Quiz(){
        return $this->belongsTo(Quiz::class);
    }
}

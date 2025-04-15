<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class UserController extends Controller
{
    //
    function welcome(){
        $categories=Category::get();
        return view('welcome',['categories'=>$categories]);
    }
}

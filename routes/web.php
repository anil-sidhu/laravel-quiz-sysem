<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Tutorialscontroller;




Route::get('/',[UserController::class,'welcome']);
Route::get('user-quiz-list/{id}/{category}',[UserController::class,'userQuizList']);
Route::get('start-quiz/{id}/{name}',[UserController::class,'startQuiz']);
// Route::view('user-signup','user-signup');
Route::post('user-signup',[UserController::class,'userSignup']);
Route::get('user-logout',[UserController::class,'userLogout']);
Route::get('user-signup-quiz',[UserController::class,'userSignupQuiz']);

Route::get('categories-list',[UserController::class,'categories']);
Route::get('certificate',[UserController::class,'certificate']);
Route::get('courses',[UserController::class,'courses']);
Route::get('course-details/{c_id}/{c_title}/',[UserController::class,'courseDetails']);
Route::get('topic/{c_id}/{t_id}/{t_title}/',[UserController::class,'topic']);







Route::get('user-login',function(){
    if(!session()->has('user')){
       return view('user-login');
    }else{
        return redirect('/');
    }
});
Route::get('user-signup',function(){
    if(!session()->has('user')){
       return view('user-signup');
    }else{
        return redirect('/');
    }
});
// Route::view('user-login','user-login');
Route::post('user-login',[UserController::class,'userLogin']);
Route::get('user-login-quiz',[UserController::class,'userLoginQuiz']);
Route::get('search-quiz',[UserController::class,'searchQuiz']);

Route::get('verify-user/{email}',[UserController::class,'verifyUser']);
Route::view('user-forgot-password','user-forgot-password');
Route::post('user-forgot-password',[UserController::class,'userForgotPassword']);
Route::get('user-forgot-password/{email}',[UserController::class,'userResetForgotPassword']);
Route::post('user-set-forgot-password',[UserController::class,'userSetForgotPassword']);
Route::view('tutorials','create-tutorial');



Route::middleware('CheckUserAuth')->group(function(){
    Route::get('user-details',[UserController::class,'userDetails']);
    Route::post('submit-next/{id}',[UserController::class,'submitAndNext']);
    Route::get('mcq/{id}/{name}',[UserController::class,'mcq']);
    Route::get('download-certificate',[UserController::class,'downloadCertificate']);
});

Route::view('admin-login','admin-login');

Route::post('admin-login',[AdminController::class,'login']);


Route::middleware('CheckAdminAuth')->group(function(){
    Route::get('dashboard',[AdminController::class,'dashboard']);
Route::get('admin-categories',[AdminController::class,'categories']);
Route::get('admin-logout',[AdminController::class,'logout']);
Route::post('add-category',[AdminController::class,'addCategory']);
Route::get('category/delete/{id}',[AdminController::class,'deleteCategory']);
Route::get('add-quiz',[AdminController::class,'addQuiz']);
Route::post('add-mcq',[AdminController::class,'addMCQs']);
Route::get('end-quiz',[AdminController::class,'endQuiz']);
Route::get('show-quiz/{id}/{quizName}',[AdminController::class,'showQuiz']);
Route::get('quiz-list/{id}/{category}',[AdminController::class,'quizList']);
Route::get('add-course',[AdminController::class,'addCourseView']);
Route::post('add-course',[AdminController::class,'addCourse']);

Route::get('add-topic',[AdminController::class,'addTopicView']);
Route::post('add-topic',[AdminController::class,'addTopic']);



});







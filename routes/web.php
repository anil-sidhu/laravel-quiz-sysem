<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Tutorialscontroller;
use Illuminate\Support\Facades\Artisan;



Route::get('/',[UserController::class,'welcome']);
Route::get('user-quiz-list/{id}/{category}',[UserController::class,'userQuizList']);
Route::get('start-quiz/{id}/{name}',[UserController::class,'startQuiz']);
// Route::view('user-signup','user-signup');
Route::post('user-signup',[UserController::class,'userSignup']);
Route::get('user-logout',[UserController::class,'userLogout']);
Route::get('user-signup-quiz',[UserController::class,'userSignupQuiz']);
Route::get('user-signup-verify', [UserController::class, 'showSignupOtpForm']);
Route::post('user-signup-verify', [UserController::class, 'verifySignupOtp']);
Route::post('user-signup-verify/resend', [UserController::class, 'resendSignupOtp']);

Route::get('categories-list',[UserController::class,'categories']);
Route::get('certificate',[UserController::class,'certificate']);
Route::get('verify',[UserController::class,'showVerifyCertificate']);
Route::post('verify',[UserController::class,'verifyCertificate']);
Route::get('courses',[UserController::class,'courses']);
Route::get('live-training/{slug}', [UserController::class, 'liveTrainingProgram'])->name('live-training.show');
Route::get('course-details/{c_id}/{c_title}/',[UserController::class,'courseDetails']);
Route::get('topic/{c_id}/{t_id}/{t_title}/',[UserController::class,'topic']);
Route::get('anil-sidhu', function() {
    return view('about-me');
});







Route::get('user-login',function(){
    if(!session()->has('user')){
        // Clear login session if coming from OTP page
        if(request('reset')){
            session()->forget(['login_user_id', 'login_otp_attempts', 'login_redirect_url']);
        }
        return view('user-login');
    }else{
        return redirect('/');
    }
});
Route::get('user-signup',function(){
    if(!session()->has('user')){
        // Clear signup session if coming from OTP page
        if(request('reset')){
            session()->forget(['signup_user_id', 'signup_otp_attempts']);
        }
        return view('user-signup');
    }else{
        return redirect('/');
    }
});
// Route::view('user-login','user-login');
Route::post('user-login',[UserController::class,'userLogin']);
Route::get('user-login-quiz',[UserController::class,'userLoginQuiz']);
Route::get('search-quiz',[UserController::class,'searchQuiz']);
Route::get('user-login-verify', [UserController::class, 'showLoginOtpForm']);
Route::post('user-login-verify', [UserController::class, 'verifyLoginOtp']);
Route::post('user-login-verify/resend', [UserController::class, 'resendLoginOtp']);

Route::get('verify-user/{email}',[UserController::class,'verifyUser']);

// SMS-based Password Reset Routes
Route::view('user-forgot-password','user-forgot-password');
Route::post('user-forgot-password',[UserController::class,'userForgotPassword']);
Route::get('user-forgot-password-verify',[UserController::class,'showForgotPasswordOtpForm']);
Route::post('user-forgot-password-verify',[UserController::class,'verifyForgotPasswordOtp']);
Route::post('user-forgot-password-resend',[UserController::class,'resendForgotPasswordOtp']);
Route::get('user-set-forgot-password',[UserController::class,'userResetForgotPassword']);
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
    Route::get('course-analytics', [AdminController::class, 'courseAnalytics']);
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('admin-logout',[AdminController::class,'logout'])->name('admin-logout');
    Route::get('admin-categories',[AdminController::class,'categories']);
    Route::post('add-category',[AdminController::class,'addCategory']);
    Route::get('category/delete/{id}',[AdminController::class,'deleteCategory']);
    Route::get('add-quiz',[AdminController::class,'addQuiz']);
    Route::post('add-mcq',[AdminController::class,'addMCQs']);
    Route::get('end-quiz',[AdminController::class,'endQuiz']);
    Route::get('show-quiz/{id}/{quizName}',[AdminController::class,'showQuiz']);
    Route::get('quiz-list/{id}/{category}',[AdminController::class,'quizList']);
    Route::get('delete-quiz/{id}',[AdminController::class,'deleteQuiz']);
    Route::get('delete-mcq/{id}',[AdminController::class,'deleteMcq']);
    Route::get('all-quizzes',[AdminController::class,'allQuizzes']);
    Route::get('add-course',[AdminController::class,'addCourseView']);
    Route::post('add-course',[AdminController::class,'addCourse']);
    Route::get('add-topic',[AdminController::class,'addTopicView']);
    Route::post('add-topic',[AdminController::class,'addTopic']);
    Route::get('admin-course/topics/{c_id}',[AdminController::class,'topics']);
    Route::get('admin-course',[AdminController::class,'course']);
    Route::get('edit-topic/{id}',[AdminController::class,'editTopic']);
    Route::post('edit-topic/{id}',[AdminController::class,'updateTopic']);
    Route::get('delete-topic/{id}',[AdminController::class,'deleteTopic']);
    Route::post('admin/users/{user}/update-status', [AdminController::class, 'updateUserStatus'])->name('admin.updateUserStatus');
});

// Migration route for cPanel (remove after running)
Route::get('/run-specific-migrations', function () {
    try {
        // Run the specific migration by path
        Artisan::call('migrate', [
            '--path' => 'database/migrations',
            '--force' => true
        ]);
        
        $output = Artisan::output();
        return '<h1>Migrations ran successfully!</h1><pre>' . $output . '</pre>';
    } catch (Exception $e) {
        return '<h1>Migration Failed!</h1><pre>' . $e->getMessage() . '</pre>';
    }
});

// Check migration status
Route::get('/check-migrations', function () {
    try {
        Artisan::call('migrate:status');
        $output = Artisan::output();
        return '<h1>Migration Status</h1><pre>' . $output . '</pre>';
    } catch (Exception $e) {
        return '<h1>Error!</h1><pre>' . $e->getMessage() . '</pre>';
    }
});

// Clear route cache
Route::get('/clear-route-cache', function () {
    try {
        Artisan::call('route:clear');
        $output = Artisan::output();
        return '<h1>Route Cache Cleared Successfully!</h1><pre>' . $output . '</pre>';
    } catch (Exception $e) {
        return '<h1>Route Cache Clear Failed!</h1><pre>' . $e->getMessage() . '</pre>';
    }
});

// Clear all cache (config, route, view, application)
Route::get('/clear-all-cache', function () {
    try {
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        
        $output = "Route cache cleared\nConfig cache cleared\nView cache cleared\nApplication cache cleared";
        return '<h1>All Cache Cleared Successfully!</h1><pre>' . $output . '</pre>';
    } catch (Exception $e) {
        return '<h1>Cache Clear Failed!</h1><pre>' . $e->getMessage() . '</pre>';
    }
});

// Clear config cache
Route::get('/clear-config-cache', function () {
    try {
        Artisan::call('config:clear');
        $output = Artisan::output();
        return '<h1>Config Cache Cleared Successfully!</h1><pre>' . $output . '</pre>';
    } catch (Exception $e) {
        return '<h1>Config Cache Clear Failed!</h1><pre>' . $e->getMessage() . '</pre>';
    }
});

// Clear view cache
Route::get('/clear-view-cache', function () {
    try {
        Artisan::call('view:clear');
        $output = Artisan::output();
        return '<h1>View Cache Cleared Successfully!</h1><pre>' . $output . '</pre>';
    } catch (Exception $e) {
        return '<h1>View Cache Clear Failed!</h1><pre>' . $e->getMessage() . '</pre>';
    }
});





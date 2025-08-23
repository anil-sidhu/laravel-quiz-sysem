<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;



use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\Record;
use App\Models\MCQ_Record;
use App\Mail\VerifyUser;
use App\Mail\UserForgotPassword;
use App\Models\Tutorial;
use App\Models\Course;


class UserController extends Controller
{
    //
    function welcome(){
       $categories=Category::withCount('quizzes')->orderBy('quizzes_count','desc')->take(12)->get();
        
       $quizData=Quiz::withCount('Records')->orderBy('records_count','desc')->take(12)->get();
       $courses=Course::orderBy('id','desc')->paginate(12);

        return view('welcome',['categories'=>$categories,'quizData'=>$quizData,'courses'=>$courses]);
    }

    function categories(){

        $categories=Category::withCount('quizzes')->orderBy('quizzes_count','desc')->paginate(20);
   return view('categories-list',['categories'=>$categories]);
      }
 
    function userQuizList($id,$category){
     
        $quizData=Quiz::withCount('Mcq')->where('category_id',$id)->get();
           return view('user-quiz-list',["quizData"=>$quizData,'category'=>$category]);
      
    }

    function startQuiz($id, $name) {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $mcqs = Mcq::where('quiz_id', $id)->get();
        $quizName = $name;

        if ($mcqs->isEmpty()) {
            // Show a message or redirect if no MCQs are available
            return view('start-quiz', [
                'quizName' => $quizName,
                'quizCount' => $quizCount,
                'noQuestions' => true
            ]);
        }

        Session::put('firstMCQ', $mcqs[0]);
        return view('start-quiz', [
            'quizName' => $quizName,
            'quizCount' => $quizCount
        ]);
    }

    function userSignup(Request $request){
      $validate = $request->validate([
        'name'=>'required | min:3',
        // 'email'=>'required | email | unique:users',
        'password'=>'required | min:3',
        'mobile'   => 'required|numeric|digits:10|unique:users',
        'interested_in_training' => 'required|in:yes,no',
      ], [
        'mobile.unique' => 'Mobile number already in use. Please log in if you\'re an existing user.'
      ]);

      // Check if user needs phone verification
      $needsPhoneVerification = $request->interested_in_training === 'yes' || $request->has('leads');

      $userData = [
        'name'=>$request->name,
        'email'=>"user_" . time() . "_" . rand(1000, 9999) . "@temp.com",
        'mobile'=>$request->mobile,
        'password'=>Hash::make($request->password),
        'interested_in_training'=>$request->interested_in_training,
        // 'leads'=>$request->has('leads') ? true : false,
        'passing_year' => $request->passing_year,
      ];

      if ($needsPhoneVerification) {
        // Create user without OTP (Sharpener Tech will handle OTP generation)
        $user = User::create($userData);

        // Send OTP via Sharpener Tech
        try {
          $sms = app(\App\Services\SharpenerTechService::class);
          $result = $sms->sendOtp($user->mobile, $user->name);
          
          // Check if OTP was sent successfully
          if (isset($result['status']) && $result['status'] !== 'success') {
            // If OTP sending failed, delete the user and show error
            $user->delete();
            $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to send OTP. Please try again.';
            if ($request->ajax()) {
              return response()->json([
                'success' => false,
                'message' => $errorMessage
              ], 500);
            }
            return redirect('/user-signup')->with('message-error', $errorMessage);
          }
        } catch (\Exception $e) {
          // If OTP sending failed, delete the user and show error
          $user->delete();
          if ($request->ajax()) {
            return response()->json([
              'success' => false,
              'message' => 'Failed to send OTP. Please try again.'
            ], 500);
          }
          return redirect('/user-signup')->with('message-error', 'Failed to send OTP. Please try again.');
        }

        // Store user id in session for verification
        session(['signup_user_id' => $user->id]);
        session(['signup_otp_attempts' => 0]);

        // Handle AJAX vs regular requests
        if ($request->ajax()) {
          return response()->json([
            'success' => true,
            'redirect' => '/user-signup-verify',
            'message' => 'OTP sent to your mobile. Please verify to complete signup.'
          ])->withCookie('remember_token', $user->remember_token, 2628000);
        }

        // Redirect to OTP verification page
        return redirect('/user-signup-verify');
      } else {
        // No phone verification needed, directly create user and log them in
        $user = User::create($userData);

        // Set remember me token for new users
        $rememberToken = Str::random(60);
        $user->remember_token = $rememberToken;
        $user->save();
        
        // Set cookie that expires in 5 years
        Cookie::queue('remember_token', $rememberToken, 2628000); // 5 years in minutes

        // Log in user directly
        Session::put('user', $user);
        
        // Handle AJAX vs regular requests
        if ($request->ajax()) {
          return response()->json([
            'success' => true,
            'message' => 'User registered successfully!'
          ])->withCookie('remember_token', $user->remember_token, 2628000);
        }

        if (Session::has('quiz-url')) {
          $url = Session::get('quiz-url');
          Session::forget('quiz-url');
          return redirect($url)->with('message-success', "User registered successfully");
        } else {
          return redirect('/')->with('message-success', "User registered successfully");
        }
      }
    }


    function userLogout(){
      // Clear session
      Session::forget('user');
      
      // Clear remember token from user
      if(Session::has('user')) {
        $user = Session::get('user');
        $user->remember_token = null;
        $user->save();
      }
      
      // Clear remember token cookie
      Cookie::queue(Cookie::forget('remember_token'));
      
      return redirect('/');
    }
    function userSignupQuiz(){
     Session::put('quiz-url',url()->previous());
      return view('user-signup');
    }


    function userLogin(Request $request){
      $validate = $request->validate([
        'mobile'   => 'required|numeric|digits:10',
        'password'=>'required',
      ]);

     $user= User::where('mobile',$request->mobile)->first();
     if(!$user || !Hash::check($request->password,$user->password)){
      if($request->ajax()) {
        return response()->json([
          'success' => false,
          'message' => 'User not valid, Please check mobile and password again'
        ], 422);
      }
      return redirect('user-login')->with('message-error',"User not valid, Please check mobile number and password again");
     }

     // Check if user needs mobile verification but hasn't completed it
     $needsVerification = ($user->interested_in_training === 'yes' || $user->leads == true) && is_null($user->mobile_verified_at);
     
     if($needsVerification){
       // Send OTP via Sharpener Tech (they handle OTP generation)
       try {
         $sms = app(\App\Services\SharpenerTechService::class);
         $result = $sms->sendOtp($user->mobile, $user->name);
         
         // Check if OTP was sent successfully
         if (isset($result['status']) && $result['status'] !== 'success') {
           $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to send OTP. Please try again.';
           if ($request->ajax()) {
             return response()->json([
               'success' => false,
               'message' => $errorMessage
             ], 500);
           }
           return redirect('/user-login')->with('message-error', $errorMessage);
         }
       } catch (\Exception $e) {
         if ($request->ajax()) {
           return response()->json([
             'success' => false,
             'message' => 'Failed to send OTP. Please try again.'
           ], 500);
         }
         return redirect('/user-login')->with('message-error', 'Failed to send OTP. Please try again.');
       }

       // Store user id in session for verification
       session(['login_user_id' => $user->id]);
       session(['login_otp_attempts' => 0]);
       session(['login_redirect_url' => Session::has('quiz-url') ? Session::get('quiz-url') : '/']);

       if($request->ajax()) {
         return response()->json([
           'success' => true,
           'redirect' => '/user-login-verify',
           'message' => 'Please verify your mobile number to complete login.'
         ]);
       }

       return redirect('/user-login-verify')->with('message-info', 'Please verify your mobile number to complete login.');
     }

      if($user){
        Session::put('user',$user);
        
        // Set remember me cookie for 5 years (forever)
        $rememberToken = Str::random(60);
        $user->remember_token = $rememberToken;
        $user->save();
        
        // Set cookie that expires in 5 years
        Cookie::queue('remember_token', $rememberToken, 2628000); // 5 years in minutes
        
        if($request->ajax()) {
          return response()->json([
            'success' => true,
            'message' => 'Login successful!'
          ])->withCookie('remember_token', $rememberToken, 2628000);
        }
        
        if(Session::has('quiz-url')){
         
          $url=Session::get('quiz-url');
          Session::forget('quiz-url');
          return redirect($url);
        }else{
          return redirect('/');
        }
        
        
      }
      
}
function userLoginQuiz(){
  Session::put('quiz-url',url()->previous());
   return view('user-login');
 }

 function mcq($id,$name){
  $record= new Record();
  $record->user_id=Session::get('user')->id;
  $record->quiz_id=Session::get('firstMCQ')->quiz_id;
  $record->status=1;
  if($record->save()){
    $currentQuiz=[];
    $currentQuiz['totalMcq']=MCQ::where('quiz_id',Session::get('firstMCQ')->quiz_id)->count();
    $currentQuiz['currentMcq']=1;
    $currentQuiz['quizName']=$name;
    $currentQuiz['quizId']=Session::get('firstMCQ')->quiz_id;
    $currentQuiz['recordId']=$record->id;

    Session::put('currentQuiz',$currentQuiz);
    $mcqData=MCQ::find($id);
   return view('mcq-page',['quizName'=>$name,'mcqData'=>$mcqData]); 
  }else{
    return "Something went wrong";
  }


  
 }

 function submitAndNext(Request $request, $id){
  $currentQuiz= Session::get('currentQuiz');
   $currentQuiz['currentMcq']+=1;
   $mcqData = MCQ::where([
    ['id','>',$id],
  ['quiz_id','=',$currentQuiz['quizId']]
  ])->first();

   $isExist= MCQ_Record::where([
    ['record_id','=',$currentQuiz['recordId']],
    ['mcq_id','=',$request->id],
  ])->count();
  if($isExist<1){
    $mcq_record= new MCQ_Record;
    $mcq_record->record_id=$currentQuiz['recordId'];
    $mcq_record->user_id=Session::get('user')->id;
    $mcq_record->mcq_id=$request->id;
    $mcq_record->select_answer=$request->option;
    if($request->option ==  MCQ::find($request->id)->correct_ans)
    {
      $mcq_record->is_correct=1;
    }else{
      $mcq_record->is_correct=0;
    }
  
    if(!$mcq_record->save())
    {
      return "something went wrong";
    }
  }
 
 


  Session::put('currentQuiz',$currentQuiz);
if($mcqData){
  return view('mcq-page',['quizName'=>$currentQuiz['quizName'],'mcqData'=>$mcqData]);
}else{

   $resultData=MCQ_record::WithMCQ()->where('record_id',$currentQuiz['recordId'])->get();
   $correctAnswers=MCQ_record::where([
    ['record_id','=',$currentQuiz['recordId']],
    ['is_correct','=',1],

   ])->count();

   $record = Record::find($currentQuiz['recordId']);
   if($record){
    $record->status=2;
    $record->update();
   }
  return view('quiz-result',['resultData'=>$resultData,'correctAnswers'=>$correctAnswers]);
}

 }


 function userDetails(){
   $quizRecord = Record::WithQuiz()->where('user_id',Session::get('user')->id)->get();
  return view('user-details',['quizRecord'=>$quizRecord]);
 }

 function searchQuiz(Request $request){
  $quizData = Quiz::withCount('Mcq')->where('name','Like','%'.$request->search.'%')->get();
  return view('quiz-search',['quizData'=>$quizData,'quiz'=>$request->search]);
 }
    
 function verifyUser($email){
 echo $orgEmail = Crypt::decryptString($email);
 $user= User::where('mobile',$orgEmail)->first();
 if($user){
  $user->active=2;

  if($user->save())
  {
    return redirect('/')->with('message-success',"User verified successfully");

  }
 }

 }


 function userForgotPassword(Request $request){

  $link = Crypt::encryptString($request->mobile);
  $link = url('/user-forgot-password/'.$link);
 Mail::to($request->mobile)->send(new UserForgotPassword($link));
 return redirect('/')->with('message-success',"Please check email to set new password");
 }

 function userResetForgotPassword($email){
   $orgEmail = Crypt::decryptString($email);
   return view('user-set-forgot-password',['email'=>$orgEmail]);
 }

 function userSetForgotPassword(Request $request){

  $validate = $request->validate([
    'email'=>'required | email |',
    'password'=>'required | min:3 | confirmed',
  ]);

  $user= User::where('email',$request->email)->first();
  if($user){
    $user->password=Hash::make($request->password);
   if( $user->save()){
    return redirect('user-login')->with('message-success',"New password is set, Please login with new Password");
   }
  }

 }

 function certificate(){
  $data=[];

  $data['quiz']= str_replace('-',' ',Session::get('currentQuiz')['quizName']);
  $data['name']= Session::get('user')['name'];
  return  view('certificate',['data'=>$data]);
 }

 function downloadCertificate(){
  $data=[];
  $data['quiz']= str_replace('-',' ',Session::get('currentQuiz')['quizName']);
  $data['name']= Session::get('user')['name'];
  $html=  view('download-certificate',['data'=>$data])->render();
  return response(
    Browsershot::html($html)->pdf()
  )->withHeaders(
    [
      'Content-Type'=>"application/pdf",
      'Content-disposition'=>"attachment;filename=certificate.pdf"
    ]
    );
 }

 function topic($c_id,$t_id,$title){
   $currentTopic= Tutorial::find($t_id);
   $courses= Course::get();
   $relatedTopics= Tutorial::where('course_id',$c_id)->get();

  return view('tutorial',['currentTopic'=>$currentTopic,'relatedTopics'=>$relatedTopics,'courses'=>$courses]);
 }

 function courses(){
  $courses= Course::get();
  return view('course-list',['courses'=>$courses]);
 }

 function courseDetails($id,$title){
  $topics= Tutorial::where('course_id',$id)->get();
  $course= Course::find($id);
  return view('course-details',['topics'=>$topics,'title'=>$title,'course'=>$course]);
 }

    // Show OTP verification form
    public function showSignupOtpForm()
    {
        if (!session('signup_user_id')) {
            return redirect('/user-signup');
        }
        return view('user-signup-verify');
    }

    // Handle OTP verification
    public function verifySignupOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        $userId = session('signup_user_id');
        $user = User::find($userId);
        if (!$user) {
            return redirect('/user-signup')->with('message-error', 'Session expired. Please sign up again.');
        }
        // Limit attempts
        $attempts = session('signup_otp_attempts', 0) + 1;
        session(['signup_otp_attempts' => $attempts]);
        if ($attempts > 5) {
            session()->forget(['signup_user_id', 'signup_otp_attempts']);
            return redirect('/user-signup')->with('message-error', 'Too many attempts. Please sign up again.');
        }
        // Verify OTP using Sharpener Tech API
        try {
            $sms = app(\App\Services\SharpenerTechService::class);
            $result = $sms->verifyOtp($user->mobile, $request->otp, $user->name);
            
            if (isset($result['status']) && $result['status'] !== 'success') {
                return back()->with('message-error', 'Invalid or expired OTP.')->withInput();
            }
            
            // Mark as verified
            $user->mobile_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            session()->forget(['signup_user_id', 'signup_otp_attempts']);
            // Log in user
            Session::put('user', $user);
            return redirect('/')->with('message-success', 'Mobile verified and signup complete!');
        } catch (\Exception $e) {
            return back()->with('message-error', 'Failed to verify OTP. Please try again.')->withInput();
        }
    }

    // Resend OTP
    public function resendSignupOtp(Request $request)
    {
        $userId = session('signup_user_id');
        $user = User::find($userId);
        if (!$user) {
            if ($request->ajax()) {
                return response('Session expired. Please sign up again.', 419);
            }
            return redirect('/user-signup');
        }
        try {
            $sms = app(\App\Services\SharpenerTechService::class);
            $result = $sms->sendOtp($user->mobile, $user->name);
            // Check for Sharpener Tech API specific error responses
            if (isset($result['status']) && $result['status'] !== 'success') {
                $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to resend OTP. Please try again later.';
                if ($request->ajax()) {
                    return response($errorMessage, 500);
                }
                return back()->with('message-error', $errorMessage);
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response('Failed to resend OTP. Please try again later.', 500);
            }
            // Optionally handle SMS failure
        }
        session(['signup_otp_attempts' => 0]);
        if ($request->ajax()) {
            return response('OTP resent successfully.', 200);
        }
        return back()->with('message-success', 'OTP resent successfully.');
    }

    // Show OTP verification form for login
    public function showLoginOtpForm()
    {
        if (!session('login_user_id')) {
            return redirect('/user-login');
        }
        return view('user-login-verify');
    }

    // Handle OTP verification for login
    public function verifyLoginOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
        $userId = session('login_user_id');
        $user = User::find($userId);
        if (!$user) {
            return redirect('/user-login')->with('message-error', 'Session expired. Please login again.');
        }
        // Limit attempts
        $attempts = session('login_otp_attempts', 0) + 1;
        session(['login_otp_attempts' => $attempts]);
        if ($attempts > 5) {
            session()->forget(['login_user_id', 'login_otp_attempts', 'login_redirect_url']);
            return redirect('/user-login')->with('message-error', 'Too many attempts. Please login again.');
        }
        // Verify OTP using Sharpener Tech API
        try {
            $sms = app(\App\Services\SharpenerTechService::class);
            $result = $sms->verifyOtp($user->mobile, $request->otp, $user->name);
            
            if (isset($result['status']) && $result['status'] !== 'success') {
                return back()->with('message-error', 'Invalid or expired OTP.')->withInput();
            }
            
            // Mark as verified
            $user->mobile_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            
            // Get redirect URL and clean up session
            $redirectUrl = session('login_redirect_url', '/');
            session()->forget(['login_user_id', 'login_otp_attempts', 'login_redirect_url']);
            
            // Log in user
            Session::put('user', $user);
            return redirect($redirectUrl)->with('message-success', 'Mobile verified and login complete!');
        } catch (\Exception $e) {
            return back()->with('message-error', 'Failed to verify OTP. Please try again.')->withInput();
        }
    }

    // Resend OTP for login
    public function resendLoginOtp(Request $request)
    {
        $userId = session('login_user_id');
        $user = User::find($userId);
        if (!$user) {
            if ($request->ajax()) {
                return response('Session expired. Please login again.', 419);
            }
            return redirect('/user-login');
        }
        try {
            $sms = app(\App\Services\SharpenerTechService::class);
            $result = $sms->sendOtp($user->mobile, $user->name);
            // Check for Sharpener Tech API specific error responses
            if (isset($result['status']) && $result['status'] !== 'success') {
                $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to resend OTP. Please try again later.';
                if ($request->ajax()) {
                    return response($errorMessage, 500);
                }
                return back()->with('message-error', $errorMessage);
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response('Failed to resend OTP. Please try again later.', 500);
            }
            // Optionally handle SMS failure
        }
        session(['login_otp_attempts' => 0]);
        if ($request->ajax()) {
            return response('OTP resent successfully.', 200);
        }
        return back()->with('message-success', 'OTP resent successfully.');
    }

}

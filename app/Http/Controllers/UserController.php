<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
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
use App\Models\Certificate;
use App\Services\SelfHostedSmsOtpService;


class UserController extends Controller
{
    //
    function welcome(){
       $categories=Category::withCount('quizzes')->orderBy('quizzes_count','desc')->take(12)->get();
        
       $quizData=Quiz::withCount('Records')->orderBy('records_count','desc')->take(12)->get();
       $courses=Course::orderBy('id','desc')->paginate(12);

        return view('welcome', [
            'categories' => $categories,
            'quizData' => $quizData,
            'courses' => $courses,
            'trainingPrograms' => config('training_programs.programs', []),
        ]);
    }

    /**
     * Public page for a single live / instructor-led program (curriculum + enroll CTAs).
     */
    public function liveTrainingProgram(string $slug)
    {
        $programs = config('training_programs.programs', []);
        $program = collect($programs)->firstWhere('slug', $slug);
        if (! $program) {
            abort(404);
        }

        return view('live-training-program', [
            'program' => $program,
            'allPrograms' => $programs,
        ]);
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
      // Get the referrer URL (the page user came from)
      $referrerUrl = $request->header('referer');
      $redirectUrl = '/';
      
      // Extract course tracking information from referrer URL
      $courseId = null;
      $sourceType = 'other';
      
      if ($referrerUrl) {
          // Pattern: /topic/6/21/title -> Course ID = 6 (topic page)
          if (preg_match('/\/topic\/(\d+)\/\d+\//', $referrerUrl, $matches)) {
              $courseId = (int)$matches[1];
              $sourceType = 'topic_page';
              $redirectUrl = $referrerUrl; // Redirect back to topic page
              Log::info('User signup from topic page', [
                  'referrer' => $referrerUrl,
                  'course_id' => $courseId
              ]);
          }
          // Pattern: /course-details/6/title -> Course ID = 6 (course page)
          elseif (preg_match('/\/course-details\/(\d+)\//', $referrerUrl, $matches)) {
              $courseId = (int)$matches[1];
              $sourceType = 'course_page';
              Log::info('User signup from course details page', [
                  'referrer' => $referrerUrl,
                  'course_id' => $courseId
              ]);
          }
          // Homepage or other pages on the same domain
          elseif (str_contains($referrerUrl, 'thecodingskills.com')) {
              $sourceType = 'homepage';
              Log::info('User signup from homepage/other page', ['referrer' => $referrerUrl]);
          }
      }
      
      // Override with explicit redirect URL if provided
      if ($request->has('redirect_url')) {
          $redirectUrl = $request->redirect_url;
      } elseif (Session::has('quiz-url')) {
          $redirectUrl = Session::get('quiz-url');
      }
      
      // Enhanced logging with course tracking
      Log::info('User signup request with course tracking', [
        'all_data' => $request->all(),
        'has_redirect_url' => $request->has('redirect_url'),
        'redirect_url' => $request->get('redirect_url'),
        'referrer_url' => $referrerUrl,
        'final_redirect_url' => $redirectUrl,
        'extracted_course_id' => $courseId,
        'source_type' => $sourceType
      ]);
      
      // Simple mobile validation - accept 7-15 digits for all countries
      $validate = $request->validate([
        'name'=>'required | min:3',
        'password'=>'required | min:3',
        'mobile'   => ['required', 'numeric', 'digits_between:7,15', 'unique:users'],
        'interested_in_training' => 'required|in:yes,no',
        'country' => 'nullable|in:India,Pakistan,Bangladesh,Nepal,Sri Lanka,Other',
      ], [
        'mobile.unique' => 'Mobile number already in use. Please log in if you\'re an existing user.',
        'mobile.digits_between' => 'Please enter a valid mobile number (7-15 digits).'
      ]);

      $shouldBypassOtp = $this->shouldBypassOtp($request->country);
      $needsPhoneVerification = !$shouldBypassOtp;

      $userData = [
        'name'=>$request->name,
        'email'=>"user_" . time() . "_" . rand(1000, 9999) . "@temp.com",
        'mobile'=>$request->mobile,
        'password'=>Hash::make($request->password),
        'interested_in_training'=>$request->interested_in_training,
        'country' => $request->country ?? 'India',
        // 'leads'=>$request->has('leads') ? true : false,
        'passing_year' => $request->passing_year,
        // Course tracking fields
        'signup_source_course_id' => $courseId,
        'signup_source_page_url' => $referrerUrl,
        'signup_source_type' => $sourceType,
        'signup_tracked_at' => now(),
      ];

      // Auto-verify and skip OTP when bypass is enabled (global or non-India)
      if ($shouldBypassOtp) {
        $userData['mobile_verified_at'] = now();
        $user = User::create($userData);
        
        // Log user in directly
        Session::put('user', $user);
        
        // Set remember me cookie
        $rememberToken = Str::random(60);
        $user->remember_token = $rememberToken;
        $user->save();
        Cookie::queue('remember_token', $rememberToken, 2628000);
        
        Log::info('User signed up — mobile auto-verified (OTP bypass)', [
          'user_id' => $user->id,
          'mobile' => $user->mobile,
          'country' => $user->country,
          'bypass_all_otp' => config('sms.bypass_all_otp', true),
        ]);
        
        if ($request->ajax()) {
          return response()->json([
            'success' => true,
            'message' => 'Signup successful!',
            'redirect' => $redirectUrl
          ])->withCookie('remember_token', $rememberToken, 2628000);
        }
        
        return redirect($redirectUrl);
      }

      if ($needsPhoneVerification) {
        $user = User::create($userData);

        try {
          $otpService = app(SelfHostedSmsOtpService::class);
          $result = $otpService->sendOtpForUser($user);

          if (isset($result['status']) && $result['status'] !== 'success') {
            $user->delete();
            $errorMessage = $result['message'] ?? 'Failed to send OTP. Please try again.';
            if ($request->ajax()) {
              return response()->json([
                'success' => false,
                'message' => $errorMessage
              ], 500);
            }
            return redirect('/user-signup')->with('message-error', $errorMessage);
          }
        } catch (\Exception $e) {
          $user->delete();
          Log::error('Signup OTP send failed', ['error' => $e->getMessage()]);
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
        
        // Store redirect URL (from referrer or form data)
        session(['signup_redirect_url' => $redirectUrl]);
        Log::info('Signup redirect URL stored', [
            'redirect_url' => $redirectUrl,
            'user_id' => $user->id,
            'source' => $referrerUrl && str_contains($referrerUrl, '/topic/') ? 'referrer' : 'form_data'
        ]);

        // Handle AJAX vs regular requests
        if ($request->ajax()) {
          return response()->json([
            'success' => true,
            'message' => 'OTP sent to your mobile. Please verify to complete signup.',
            'redirect' => '/user-signup-verify'
          ])->withCookie('remember_token', $user->remember_token, 2628000);
        }

        // Redirect to OTP verification page with success message
        return redirect('/user-signup-verify')->with('message-success', 'OTP sent to your mobile. Please verify to complete signup.');
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
        
        // Use the redirect URL we captured earlier (from referrer or form data)
        // $redirectUrl is already set from the beginning of the method
        
        // Handle AJAX vs regular requests
        if ($request->ajax()) {
          return response()->json([
            'success' => true,
            'message' => 'User registered successfully!',
            'redirect' => $redirectUrl
          ])->withCookie('remember_token', $user->remember_token, 2628000);
        }

        return redirect($redirectUrl)->with('message-success', "User registered successfully");
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
      // Get the referrer URL (the page user came from)
      $referrerUrl = $request->header('referer');
      $redirectUrl = '/';
      
      // If user came from a tutorial page, use that as redirect URL
      if ($referrerUrl && str_contains($referrerUrl, '/topic/')) {
          $redirectUrl = $referrerUrl;
          Log::info('User login from tutorial page', ['referrer' => $referrerUrl]);
      } elseif ($request->has('redirect_url')) {
          $redirectUrl = $request->redirect_url;
      } elseif (Session::has('quiz-url')) {
          $redirectUrl = Session::get('quiz-url');
      }
      
      $validate = $request->validate([
        'mobile'   => ['required', 'numeric', 'digits_between:7,15'],
        'password'=>'required',
      ], [
        'mobile.digits_between' => 'Please enter a valid mobile number.'
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
     $needsVerification = is_null($user->mobile_verified_at);
     
     $shouldBypassOtp = $this->shouldBypassOtp($user->country);
     
     if($needsVerification && !$shouldBypassOtp){
       try {
         $otpService = app(SelfHostedSmsOtpService::class);
         $result = $otpService->sendOtpForUser($user);

         if (isset($result['status']) && $result['status'] !== 'success') {
           $errorMessage = $result['message'] ?? 'Failed to send OTP. Please try again.';
           if ($request->ajax()) {
             return response()->json([
               'success' => false,
               'message' => $errorMessage
             ], 500);
           }
           return redirect('/user-login')->with('message-error', $errorMessage);
         }
       } catch (\Exception $e) {
         Log::error('Login OTP send failed', ['error' => $e->getMessage(), 'user_id' => $user->id]);
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
       
       // Store redirect URL (from referrer or form data)
       session(['login_redirect_url' => $redirectUrl]);

       if($request->ajax()) {
         return response()->json([
           'success' => true,
           'message' => 'Please verify your mobile number to complete login.',
           'redirect' => '/user-login-verify'
         ]);
       }

       return redirect('/user-login-verify')->with('message-info', 'Please verify your mobile number to complete login.');
     } elseif($needsVerification && $shouldBypassOtp) {
       $user->mobile_verified_at = now();
       $user->save();
       
       Log::info('Login — mobile auto-verified (OTP bypass)', [
         'user_id' => $user->id,
         'mobile' => $user->mobile,
         'country' => $user->country,
         'bypass_all_otp' => config('sms.bypass_all_otp', true),
       ]);
     }

      if($user){
        Session::put('user',$user);
        
        // Set remember me cookie for 5 years (forever)
        $rememberToken = Str::random(60);
        $user->remember_token = $rememberToken;
        $user->save();
        
        // Set cookie that expires in 5 years
        Cookie::queue('remember_token', $rememberToken, 2628000); // 5 years in minutes
        
        // Use the redirect URL we captured earlier (from referrer or form data)
        // $redirectUrl is already set from the beginning of the method
        
        if($request->ajax()) {
          return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'redirect' => $redirectUrl
          ])->withCookie('remember_token', $rememberToken, 2628000);
        }
        
        return redirect($redirectUrl);
        
        
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
  // Validate mobile number
  $request->validate([
      'mobile' => 'required|string|min:10|max:15'
  ]);

  // Find user by mobile
  $user = User::where('mobile', $request->mobile)->first();
  
  if (!$user) {
      return back()->withErrors(['mobile' => 'Mobile number not found in our records.']);
  }

  // Generate OTP for password reset
  $otp = rand(100000, 999999);
  
  // Store OTP in session with expiration (5 minutes)
  session([
      'password_reset_mobile' => $request->mobile,
      'password_reset_otp' => $otp,
      'password_reset_expires' => now()->addMinutes(5)
  ]);
  
  // Log for debugging
  \Log::info('Password Reset OTP Generated', [
      'mobile' => $request->mobile,
      'otp' => $otp,
      'otp_type' => gettype($otp),
      'session_otp' => session('password_reset_otp')
  ]);

  // Send OTP via SMS using Fast2SMS service
  try {
      $sms = app(\App\Services\Fast2SMSService::class);
      $result = $sms->sendOtp($request->mobile, $otp);
      
      if (isset($result['return']) && $result['return'] === true) {
          return redirect('/user-forgot-password-verify')->with('message-success', 'OTP sent to your mobile number. Please verify to reset password.');
      } else {
          $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to send OTP. Please try again.';
          return back()->withErrors(['mobile' => $errorMessage]);
      }
  } catch (\Exception $e) {
      \Log::error('Password reset OTP send failed: ' . $e->getMessage());
      return back()->withErrors(['mobile' => 'Failed to send OTP. Please try again.']);
  }
 }

 // Show OTP verification page for password reset
 function showForgotPasswordOtpForm(){
     if (!session('password_reset_mobile')) {
         return redirect('/user-forgot-password')->with('message-error', 'Please request password reset first.');
     }
     return view('user-forgot-password-verify');
 }

 // Verify OTP for password reset
 function verifyForgotPasswordOtp(Request $request){
     $request->validate([
         'otp' => 'required|string|size:6'
     ]);

     // Check if session data exists
     if (!session('password_reset_mobile') || !session('password_reset_otp') || !session('password_reset_expires')) {
         return redirect('/user-forgot-password')->with('message-error', 'Session expired. Please request password reset again.');
     }

     // Check if OTP is expired
     if (now()->gt(session('password_reset_expires'))) {
         session()->forget(['password_reset_mobile', 'password_reset_otp', 'password_reset_expires']);
         return redirect('/user-forgot-password')->with('message-error', 'OTP expired. Please request a new one.');
     }

     // Verify OTP (with debugging)
     $enteredOtp = trim($request->otp);
     $storedOtp = trim(session('password_reset_otp'));
     
     // Log for debugging
     \Log::info('OTP Verification Debug', [
         'entered_otp' => $enteredOtp,
         'stored_otp' => $storedOtp,
         'entered_type' => gettype($enteredOtp),
         'stored_type' => gettype($storedOtp),
         'mobile' => session('password_reset_mobile')
     ]);
     
     if ($enteredOtp !== $storedOtp) {
         return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
     }

     // OTP verified, redirect to set new password
     return redirect('/user-set-forgot-password')->with('message-success', 'OTP verified successfully. Please set your new password.');
 }

 // Resend OTP for password reset
 function resendForgotPasswordOtp(){
     if (!session('password_reset_mobile')) {
         return redirect('/user-forgot-password')->with('message-error', 'Please request password reset first.');
     }

     // Generate new OTP
     $otp = rand(100000, 999999);
     
     // Update session with new OTP
     session([
         'password_reset_otp' => $otp,
         'password_reset_expires' => now()->addMinutes(5)
     ]);

  // Send new OTP via SMS using Fast2SMS service
  try {
      $sms = app(\App\Services\Fast2SMSService::class);
      $result = $sms->sendOtp(session('password_reset_mobile'), $otp);
      
      if (isset($result['return']) && $result['return'] === true) {
          return back()->with('message-success', 'New OTP sent to your mobile number.');
      } else {
          $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to send OTP. Please try again.';
          return back()->with('message-error', $errorMessage);
      }
  } catch (\Exception $e) {
      \Log::error('Password reset OTP resend failed: ' . $e->getMessage());
      return back()->with('message-error', 'Failed to send OTP. Please try again.');
  }
 }

 function userResetForgotPassword(){
   // Check if user has valid password reset session
   if (!session('password_reset_mobile')) {
       return redirect('/user-forgot-password')->with('message-error', 'Session expired. Please request password reset again.');
   }
   
   return view('user-set-forgot-password');
 }

 function userSetForgotPassword(Request $request){
  // Check if user has valid password reset session
  if (!session('password_reset_mobile')) {
      return redirect('/user-forgot-password')->with('message-error', 'Session expired. Please request password reset again.');
  }

  $validate = $request->validate([
    'mobile' => 'required|string',
    'password' => 'required|min:3|confirmed',
  ]);

  // Verify the mobile number matches the session
  if ($request->mobile !== session('password_reset_mobile')) {
      return back()->withErrors(['mobile' => 'Invalid mobile number.']);
  }

  // Find user by mobile
  $user = User::where('mobile', $request->mobile)->first();
  
  if ($user) {
      $user->password = Hash::make($request->password);
      if ($user->save()) {
          // Clear password reset session
          session()->forget(['password_reset_mobile', 'password_reset_otp', 'password_reset_expires']);
          return redirect('user-login')->with('message-success', 'New password is set successfully. Please login with your new password.');
      }
  }

  return back()->withErrors(['password' => 'Failed to update password. Please try again.']);
 }

 function certificate(){
    // Check if user is logged in
    if (!Session::has('user')) {
        return redirect('/user-login')->with('message-error', 'Please login to view your certificate.');
    }
    
    // Check if quiz session exists
    if (!Session::has('currentQuiz')) {
        return redirect('/')->with('message-error', 'No quiz data found. Please complete a quiz first.');
    }
    
    $user = Session::get('user');
    $currentQuiz = Session::get('currentQuiz');
    $quizName = str_replace('-', ' ', $currentQuiz['quizName']);
    
    // Check if certificate already exists for this user and quiz
    $certificate = Certificate::existsForUserAndQuiz($user->id, $quizName);
    
    if (!$certificate) {
        // Generate new certificate
        $certificate = Certificate::create([
            'certificate_id' => Certificate::generateUniqueId(),
            'user_id' => $user->id,
            'student_name' => $user->name,
            'quiz_name' => $quizName,
            'score' => $currentQuiz['score'] ?? 100, // Default to 100 if not set
            'issued_at' => now(),
        ]);
    }
    
    // Generate SVG with replaced placeholders
    $svgContent = $this->generateCertificateSVG($certificate);
    
    return view('certificate', [
        'certificate' => $certificate,
        'svgContent' => $svgContent,
    ]);
 }

 /**
  * Generate certificate SVG with placeholders replaced
  */
 private function generateCertificateSVG(Certificate $certificate): string
 {
    $svgPath = public_path('img/certificate_main_final.svg');
    
    if (!file_exists($svgPath)) {
        return '<svg><text>Certificate template not found</text></svg>';
    }
    
    $svgContent = file_get_contents($svgPath);
    
    // The SVG has character-level x-positioning which breaks with simple replacement.
    // We need to replace the entire tspan content while preserving basic positioning.
    
    // ========== STUDENT NAME ==========
    // Replace student name tspan and center it by changing transform position
    // Original: transform="matrix(1,0,0,-1,228.77,413.33)" - left aligned
    // Change to center position (~350) for centering
    $svgContent = preg_replace(
        '/<text([^>]*?)transform="matrix\(1,0,0,-1,228\.77,413\.33\)"([^>]*)><tspan([^>]*?)x="[^"]*"([^>]*)>\{\{STUDENT<\/tspan><\/text>/',
        '<text$1transform="matrix(1,0,0,-1,350,413.33)" text-anchor="middle"$2><tspan$3x="0"$4>' . htmlspecialchars($certificate->student_name) . '</tspan></text>',
        $svgContent
    );
    
    // Hide the underscore text element after student name (at position 446.59,413.33)
    $svgContent = preg_replace(
        '/<text([^>]*?)transform="matrix\(1,0,0,-1,446\.59,413\.33\)"([^>]*)><tspan([^>]*)>_<\/tspan><\/text>/',
        '<text$1transform="matrix(1,0,0,-1,446.59,413.33)" style="display:none"$2><tspan$3></tspan></text>',
        $svgContent
    );
    
    // Hide the NAME}} tspan after student name (at position 467.35,413.33)
    $svgContent = preg_replace(
        '/<text([^>]*?)transform="matrix\(1,0,0,-1,467\.35,413\.33\)"([^>]*)><tspan([^>]*?)x="[^"]*"([^>]*)>NAME\}\}<\/tspan><\/text>/',
        '<text$1transform="matrix(1,0,0,-1,467.35,413.33)" style="display:none"$2><tspan$3x="0"$4></tspan></text>',
        $svgContent
    );
    
    // ========== QUIZ NAME ==========
    // Replace "has excelled in our {{QUIZ" with full quiz name
    $svgContent = preg_replace(
        '/<tspan([^>]*?)x="[^"]*"([^>]*)>has excelled in our \{\{QUIZ<\/tspan>/',
        '<tspan$1x="0"$2>has excelled in our ' . htmlspecialchars($certificate->quiz_name) . '</tspan>',
        $svgContent
    );
    
    // Hide the underscore text element after quiz name (at position 510.86,356.62)
    $svgContent = preg_replace(
        '/<text([^>]*?)transform="matrix\(1,0,0,-1,510\.86,356\.62\)"([^>]*)><tspan([^>]*)>_<\/tspan><\/text>/',
        '<text$1transform="matrix(1,0,0,-1,510.86,356.62)" style="display:none"$2><tspan$3></tspan></text>',
        $svgContent
    );
    
    // Hide the NAME}} tspan after quiz (at position 518.3,356.62)
    $svgContent = preg_replace(
        '/<text([^>]*?)transform="matrix\(1,0,0,-1,518\.3,356\.62\)"([^>]*)><tspan([^>]*?)x="[^"]*"([^>]*)>NAME\}\}\s*<\/tspan><\/text>/',
        '<text$1transform="matrix(1,0,0,-1,518.3,356.62)" style="display:none"$2><tspan$3x="0"$4></tspan></text>',
        $svgContent
    );
    
    // Hide "Development quiz" text (at position 333.36,325.66)
    $svgContent = preg_replace(
        '/<text([^>]*?)transform="matrix\(1,0,0,-1,333\.36,325\.66\)"([^>]*)><tspan([^>]*?)x="[^"]*"([^>]*)>Development quiz\s*<\/tspan><\/text>/',
        '<text$1transform="matrix(1,0,0,-1,333.36,325.66)" style="display:none"$2><tspan$3x="0"$4></tspan></text>',
        $svgContent
    );
    
    // ========== DATE ==========
    // Replace date (format: "Date: {{DATE}}")
    $svgContent = preg_replace(
        '/<tspan([^>]*?)x="[^"]*"([^>]*)>Date: \{\{DATE\}\}<\/tspan>/',
        '<tspan$1x="0"$2>Date: ' . $certificate->issued_at->format('M d, Y') . '</tspan>',
        $svgContent
    );
    
    // ========== CERTIFICATE ID ==========
    // Replace certificate ID (format: "No: {{CERTIFICATE_ID}}")
    $svgContent = preg_replace(
        '/<tspan([^>]*?)x="[^"]*"([^>]*)>No: \{\{CERTIFICATE_ID\}\}<\/tspan>/',
        '<tspan$1x="0"$2>No: ' . $certificate->certificate_id . '</tspan>',
        $svgContent
    );
    
    return $svgContent;
 }

 function downloadCertificate(){
    // Check if user is logged in
    if (!Session::has('user')) {
        return redirect('/user-login')->with('message-error', 'Please login to download your certificate.');
    }
    
    // Check if quiz session exists
    if (!Session::has('currentQuiz')) {
        return redirect('/')->with('message-error', 'No quiz data found. Please complete a quiz first.');
    }
    
    $user = Session::get('user');
    $currentQuiz = Session::get('currentQuiz');
    $quizName = str_replace('-', ' ', $currentQuiz['quizName']);
    
    // Get or create certificate
    $certificate = Certificate::existsForUserAndQuiz($user->id, $quizName);
    
    if (!$certificate) {
        $certificate = Certificate::create([
            'certificate_id' => Certificate::generateUniqueId(),
            'user_id' => $user->id,
            'student_name' => $user->name,
            'quiz_name' => $quizName,
            'score' => $currentQuiz['score'] ?? 100,
            'issued_at' => now(),
        ]);
    }
    
    // Generate SVG content
    $svgContent = $this->generateCertificateSVG($certificate);
    
    // Create HTML wrapper for PDF
    $html = '<!DOCTYPE html>
    <html>
    <head>
        <style>
            body { margin: 0; padding: 0; }
            .certificate-container { width: 100%; height: 100%; }
            svg { width: 100%; height: auto; }
        </style>
    </head>
    <body>
        <div class="certificate-container">' . $svgContent . '</div>
    </body>
    </html>';
    
    // Use DomPDF to generate PDF
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
    $pdf->setPaper('A4', 'landscape');
    $pdf->setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
        'defaultFont' => 'Arial',
        'isPhpEnabled' => true,
        'isJavascriptEnabled' => false,
    ]);
    
    $filename = 'certificate_' . $certificate->certificate_id . '.pdf';
    return $pdf->download($filename);
 }

 /**
  * Show certificate verification page
  */
 public function showVerifyCertificate()
 {
    return view('verify-certificate');
 }

 /**
  * Verify a certificate by its ID
  */
 public function verifyCertificate(Request $request)
 {
    $request->validate([
        'certificate_id' => 'required|string|max:20',
    ]);
    
    $certificateId = strtoupper(trim($request->certificate_id));
    $certificate = Certificate::findByCertificateId($certificateId);
    
    if ($request->ajax()) {
        if ($certificate) {
            return response()->json([
                'success' => true,
                'certificate' => [
                    'id' => $certificate->certificate_id,
                    'student_name' => $certificate->student_name,
                    'quiz_name' => $certificate->quiz_name,
                    'score' => $certificate->score,
                    'issued_at' => $certificate->issued_at->format('F d, Y'),
                ],
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Certificate not found. Please check the ID and try again.',
        ], 404);
    }
    
    return view('verify-certificate', [
        'certificate' => $certificate,
        'searched' => true,
        'searchedId' => $certificateId,
    ]);
 }

 /**
  * Check if user should bypass OTP verification.
  * When config sms.bypass_all_otp is true (default), everyone skips OTP until SMS API is ready.
  * When false: only India requires OTP; all other countries bypass (legacy behaviour).
  *
  * @param string|null $country Country name (detected via IP or selected by user)
  */
 private function shouldBypassOtp($country = null): bool
 {
     if (config('sms.bypass_all_otp', true)) {
         return true;
     }

     return $country !== 'India';
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
            'otp' => 'required|numeric|digits_between:4,6', // Allow 4-6 digit OTPs
        ]);
        $userId = session('signup_user_id');
        $user = User::find($userId);
        if (!$user) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please sign up again.'
                ], 419);
            }
            return redirect('/user-signup')->with('message-error', 'Session expired. Please sign up again.');
        }
        $shouldBypassOtp = $this->shouldBypassOtp($user->country);
        
        if ($shouldBypassOtp) {
            $user->mobile_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            
            Log::info('Signup verify — mobile auto-verified (OTP bypass)', [
                'user_id' => $user->id,
                'mobile' => $user->mobile,
                'country' => $user->country,
                'bypass_all_otp' => config('sms.bypass_all_otp', true),
            ]);
        } else {
            // SMS OTP path (India when bypass_all_otp is false)
            $attempts = session('signup_otp_attempts', 0) + 1;
            session(['signup_otp_attempts' => $attempts]);
            if ($attempts > 5) {
                session()->forget(['signup_user_id', 'signup_otp_attempts']);
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Too many attempts. Please sign up again.'
                    ], 429);
                }
                return redirect('/user-signup')->with('message-error', 'Too many attempts. Please sign up again.');
            }
            try {
                $otpService = app(SelfHostedSmsOtpService::class);
                $result = $otpService->verifyOtpForUser($user, (string) $request->otp);

                if (isset($result['status']) && $result['status'] !== 'success') {
                    $errorMessage = $result['message'] ?? 'Invalid or expired OTP.';
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => $errorMessage
                        ], 422);
                    }
                    return back()->with('message-error', $errorMessage)->withInput();
                }

                $user->mobile_verified_at = now();
                $user->otp_code = null;
                $user->otp_expires_at = null;
                $user->save();
            } catch (\Exception $e) {
                Log::error('OTP verification error', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id,
                    'mobile' => $user->mobile
                ]);
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'OTP verification failed. Please try again.'
                    ], 500);
                }
                return back()->with('message-error', 'OTP verification failed. Please try again.')->withInput();
            }
        }

            // Log admin attribution for analytics (no payment system)
            if ($user->signup_source_course_id) {
                $course = \App\Models\Course::find($user->signup_source_course_id);
                if ($course && $course->created_by_admin_id) {
                    Log::info('User signup attributed to admin', [
                        'admin_id' => $course->created_by_admin_id,
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                        'course_title' => $course->title,
                        'interested_in_training' => $user->interested_in_training,
                        'signup_source_type' => $user->signup_source_type
                    ]);
                }
            }
            
            // Get redirect URL before cleaning up session
            $redirectUrl = session('signup_redirect_url', '/');
            Log::info('Signup OTP verification - redirect URL retrieved', [
                'redirect_url' => $redirectUrl,
                'user_id' => $user->id,
                'session_data' => session()->all()
            ]);
            
            // Clean up session after getting redirect URL
            session()->forget(['signup_user_id', 'signup_otp_attempts', 'signup_redirect_url']);
            
            // Log in user
            Session::put('user', $user);
            
            if ($request->ajax()) {
                Log::info('Signup OTP verification - AJAX response', [
                    'redirect_url' => $redirectUrl,
                    'user_id' => $user->id
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Mobile verified and signup complete!',
                    'redirect' => $redirectUrl
                ]);
            }
            return redirect($redirectUrl)->with('message-success', 'Mobile verified and signup complete!');
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
            $otpService = app(SelfHostedSmsOtpService::class);
            $result = $otpService->sendOtpForUser($user);
            if (isset($result['status']) && $result['status'] !== 'success') {
                $errorMessage = $result['message'] ?? 'Failed to resend OTP. Please try again later.';
                if ($request->ajax()) {
                    return response($errorMessage, 500);
                }
                return back()->with('message-error', $errorMessage);
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response('Failed to resend OTP. Please try again later.', 500);
            }
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
            'otp' => 'required|numeric|digits_between:4,6', // Allow 4-6 digit OTPs
        ]);
        $userId = session('login_user_id');
        $user = User::find($userId);
        if (!$user) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please login again.'
                ], 419);
            }
            return redirect('/user-login')->with('message-error', 'Session expired. Please login again.');
        }
        $shouldBypassOtp = $this->shouldBypassOtp($user->country);
        
        if ($shouldBypassOtp) {
            $user->mobile_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            
            Log::info('Login OTP verify — mobile auto-verified (OTP bypass)', [
                'user_id' => $user->id,
                'mobile' => $user->mobile,
                'country' => $user->country,
                'bypass_all_otp' => config('sms.bypass_all_otp', true),
            ]);
        } else {
            $attempts = session('login_otp_attempts', 0) + 1;
            session(['login_otp_attempts' => $attempts]);
            if ($attempts > 5) {
                session()->forget(['login_user_id', 'login_otp_attempts', 'login_redirect_url']);
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Too many attempts. Please login again.'
                    ], 429);
                }
                return redirect('/user-login')->with('message-error', 'Too many attempts. Please login again.');
            }
            try {
                $otpService = app(SelfHostedSmsOtpService::class);
                $result = $otpService->verifyOtpForUser($user, (string) $request->otp);

                if (isset($result['status']) && $result['status'] !== 'success') {
                    $errorMessage = $result['message'] ?? 'Invalid or expired OTP.';
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => $errorMessage
                        ], 422);
                    }
                    return back()->with('message-error', $errorMessage)->withInput();
                }

                $user->mobile_verified_at = now();
                $user->otp_code = null;
                $user->otp_expires_at = null;
                $user->save();
            } catch (\Exception $e) {
                Log::error('OTP verification error during login', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id,
                    'mobile' => $user->mobile
                ]);
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'OTP verification failed. Please try again.'
                    ], 500);
                }
                return back()->with('message-error', 'OTP verification failed. Please try again.')->withInput();
            }
        }

            // Log admin attribution for analytics (no payment system)
            if ($user->signup_source_course_id) {
                $course = \App\Models\Course::find($user->signup_source_course_id);
                if ($course && $course->created_by_admin_id) {
                    Log::info('User signup attributed to admin', [
                        'admin_id' => $course->created_by_admin_id,
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                        'course_title' => $course->title,
                        'interested_in_training' => $user->interested_in_training,
                        'signup_source_type' => $user->signup_source_type
                    ]);
                }
            }
            
            // Get redirect URL and clean up session
            $redirectUrl = session('login_redirect_url', '/');
            session()->forget(['login_user_id', 'login_otp_attempts', 'login_redirect_url']);
            
            // Log in user
            Session::put('user', $user);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mobile verified and login complete!',
                    'redirect' => $redirectUrl
                ]);
            }
            return redirect($redirectUrl)->with('message-success', 'Mobile verified and login complete!');
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
            $otpService = app(SelfHostedSmsOtpService::class);
            $result = $otpService->sendOtpForUser($user);
            if (isset($result['status']) && $result['status'] !== 'success') {
                $errorMessage = $result['message'] ?? 'Failed to resend OTP. Please try again later.';
                if ($request->ajax()) {
                    return response($errorMessage, 500);
                }
                return back()->with('message-error', $errorMessage);
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response('Failed to resend OTP. Please try again later.', 500);
            }
        }
        session(['login_otp_attempts' => 0]);
        if ($request->ajax()) {
            return response('OTP resent successfully.', 200);
        }
        return back()->with('message-success', 'OTP resent successfully.');
    }

}

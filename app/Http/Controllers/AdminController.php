<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\Course;
use App\Models\Tutorial;





class AdminController extends Controller
{
    //

    function login(Request $request){
 
        $validation = $request->validate([
            "name"=>"required",
            "password"=>"required",
        ]); 

        $admin = Admin::where([
            ['name',"=",$request->name],
            ['password',"=",$request->password],
        ])->first();

        if(!$admin){
            $validation = $request->validate([
                "user"=>"required",
            ],[
                "user.required"=>"User does not exist"
            ]); 
        }
       
        Session::put('admin',$admin);
        return redirect('dashboard');

    }

    function dashboard(Request $request){
        $admin = Session::get('admin');
        if($admin){
            $query = User::query();
            
            // Advanced Filters
            // 1. Live training interest filter (interested_in_training)
            $sharpenerInterest = $request->input('sharpener_interest');
            if ($sharpenerInterest !== null && $sharpenerInterest !== '') {
                if ($sharpenerInterest === 'yes') {
                    $query->where('interested_in_training', 'yes');
                } elseif ($sharpenerInterest === 'no') {
                    $query->where('interested_in_training', 'no');
                }
            } else {
                // Default: Only users interested in training or leads
                $query->where(function($q) {
                    $q->where('interested_in_training', 'yes')
                      ->orWhere('leads', 1);
                });
            }
            
            // 2. Signup Date Filter
            $signupDateFilter = $request->input('signup_date_filter');
            if ($signupDateFilter) {
                $today = now()->format('Y-m-d');
                $yesterday = now()->subDay()->format('Y-m-d');
                $lastMonth = now()->subMonth()->format('Y-m-d');
                
                switch ($signupDateFilter) {
                    case 'today':
                        $query->whereDate('created_at', $today);
                        break;
                    case 'yesterday':
                        $query->whereDate('created_at', $yesterday);
                        break;
                    case 'last_month':
                        $query->whereDate('created_at', '>=', $lastMonth);
                        break;
                    case 'custom':
                        $startDate = $request->input('start_date');
                        $endDate = $request->input('end_date');
                        if ($startDate) {
                            $query->whereDate('created_at', '>=', $startDate);
                        }
                        if ($endDate) {
                            $query->whereDate('created_at', '<=', $endDate);
                        }
                        break;
                }
            }
            
            // 3. OTP Verification Filter
            $otpVerified = $request->input('otp_verified');
            if ($otpVerified !== null && $otpVerified !== '') {
                if ($otpVerified === 'yes') {
                    $query->whereNotNull('mobile_verified_at');
                } elseif ($otpVerified === 'no') {
                    $query->whereNull('mobile_verified_at');
                }
            }
            
            // Group by mobile to show unique users only
            $query->select('*')
                  ->whereIn('id', function($subQuery) {
                      $subQuery->selectRaw('MAX(id)')
                               ->from('users')
                               ->groupBy('mobile');
                  });
            
            // Search
            $search = $request->input('search');
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('mobile', 'like', "%$search%")
                      ->orWhere('passing_year', 'like', "%$search%")
                      ->orWhere('interested_in_training', 'like', "%$search%")
                      ->orWhere('user_status', 'like', "%$search%")
                      ->orWhereRaw("CASE WHEN mobile_verified_at IS NOT NULL THEN 'verified' ELSE 'not verified' END LIKE ?", ["%$search%"]);
                });
            }
            // Sorting
            $sort = $request->input('sort', 'id');
            $direction = $request->input('direction', 'desc');
            $allowedSorts = ['id','name','mobile','passing_year','mobile_verified_at','interested_in_training','user_status'];
            if (!in_array($sort, $allowedSorts)) $sort = 'id';
            if (!in_array($direction, ['asc','desc'])) $direction = 'desc';
            $query->orderBy($sort, $direction);
            // Pagination
            $users = $query->paginate(10)->appends($request->all());
            return view('admin', [
                "name" => $admin->name,
                'users' => $users,
                'search' => $search,
                'sharpener_interest' => $sharpenerInterest,
                'signup_date_filter' => $signupDateFilter,
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'otp_verified' => $otpVerified,
                'sort' => $sort,
                'direction' => $direction
            ]);
        }else{
            return redirect('admin-login');
        }
    }

    function categories(){
        $categories= Category::get();
        $admin = Session::get('admin');
        if($admin){
            return view('categories',["name"=>$admin->name,"categories"=>$categories]);
        }else{
            return redirect('admin-login');
        }
    }
    function logout(){
        Session::forget('admin');
        return redirect('admin-login');
    }

    function addCategory(Request $request){
        $validation = $request->validate([
            "category"=>"required | min:3 | unique:categories,name"
        ]);
        $admin = Session::get('admin');
        $category= new Category();
        $category->name=$request->category;
        $category->creator=$admin->name;
       if($category->save()){
       Session::flash('category',"Success : Category ".$request->category . " Added.");
       }
        return redirect("admin-categories");
    }

    function deleteCategory($id){
        
        $isDeleted= Category::find($id)->delete();
        if($isDeleted){
       Session::flash('category',"Success : Category deleted.");
       return redirect("admin-categories");

        }

    }

    function addQuiz(){
      
        $admin = Session::get('admin');
        $categories= Category::get();
        $totalMCQs=0;
        if($admin){
             $quizName=request('quiz');
             $category_id=request('category_id');

            if($quizName && $category_id && !Session::has('quizDetails')){
                $quiz= new Quiz();
                $quiz->name=$quizName;
                $quiz->category_id=$category_id;
                if($quiz->save()){
                    Session::put('quizDetails',$quiz);
                }

            }else{
                $quiz= Session::get('quizDetails');
                $totalMCQs = $quiz && Mcq::where('quiz_id',$quiz->id)->count();
            }

            return view('add-quiz',["name"=>$admin->name,"categories"=>$categories,"totalMCQs"=>$totalMCQs]);
        }else{
            return redirect('admin-login');
        }
    }

    function addMCQs(Request $request){
       
        $request->validate([
            "question"=>"required | min:5",
            "a"=>"required ",
            "b"=>"required",
            "d"=>"required",
            "c"=>"required",
            "correct_ans"=>"required",
        ]);
        $mcq= new Mcq();
        $quiz= Session::get('quizDetails');
        $admin= Session::get('admin');
        $mcq->question= $request->question;
        $mcq->a= $request->a;
        $mcq->b= $request->b;
        $mcq->c= $request->c;
        $mcq->d= $request->d;
        $mcq->correct_ans= $request->correct_ans;
        $mcq->admin_id= $admin->id;
        $mcq->quiz_id= $quiz->id;
        $mcq->category_id= $quiz->category_id;
        if($mcq->save()){
           if($request->submit=="add-more"){
            return redirect(url()->previous());
           }else{
            Session::forget('quizDetails');
            return redirect("/admin-categories");
           }
        }

    }
    function endQuiz(){
        Session::forget('quizDetails');
            return redirect("/admin-categories");
    }

    function showQuiz($id,$quizName){
      
        $admin = Session::get('admin');
         $mcqs=Mcq::where('quiz_id',$id)->get();
        if($admin){
            return view('show-quiz',["name"=>$admin->name,"mcqs"=>$mcqs,'quizName'=>$quizName]);
        }else{
            return redirect('admin-login');
        }
    }

    function quizList($id,$category){
        $admin = Session::get('admin');
       if($admin){
        $quizData=Quiz::where('category_id',$id)->withCount('Mcq')->get();
           return view('quiz-list',["name"=>$admin->name,"quizData"=>$quizData,'category'=>$category,'category_id'=>$id]);
       }else{
           return redirect('admin-login');
       }
    }

    function deleteQuiz($id){
        $admin = Session::get('admin');
        if($admin){
            $quiz = Quiz::find($id);
            if($quiz){
                // Delete all MCQs associated with this quiz first
                Mcq::where('quiz_id', $id)->delete();
                
                // Delete the quiz
                $quiz->delete();
                
                // Redirect back to previous page with success message
                return redirect()->back()->with('message-success', 'Quiz deleted successfully');
            }
            return redirect('/admin-categories')->with('message-error', 'Quiz not found');
        }else{
            return redirect('admin-login');
        }
    }
    
    function deleteMcq($id){
        $admin = Session::get('admin');
        if($admin){
            $mcq = Mcq::find($id);
            if($mcq){
                $quizId = $mcq->quiz_id;
                $quiz = Quiz::find($quizId);
                $quizName = $quiz ? $quiz->name : 'Unknown';
                
                $mcq->delete();
                
                return redirect('/show-quiz/'.$quizId.'/'.$quizName)->with('message-success', 'Question deleted successfully');
            }
            return redirect('/admin-categories')->with('message-error', 'Question not found');
        }else{
            return redirect('admin-login');
        }
    }
    
    function allQuizzes(){
        $admin = Session::get('admin');
        if($admin){
            $quizzes = Quiz::with('category')->withCount('Mcq')->orderBy('created_at', 'desc')->get();
            return view('all-quizzes', ["name" => $admin->name, "quizzes" => $quizzes]);
        }else{
            return redirect('admin-login');
        }
    }


    function addCourseView(){
        $admin = Session::get('admin');
       if($admin){
           return view('add-course',["name"=>$admin->name]);
       }else{
           return redirect('admin-login');
       }
    }


    function addCourse(Request $request){
        $validation = $request->validate([
            "title"=>"required | max:150 | min:10",
            "description"=>"required | max:500 | min:10",
        ]); 
        
        $admin = Session::get('admin');
        $course = new Course();
        $course->title= $request->title;
        $course->description= $request->description;
        $course->created_by_admin_id= $admin->id;
        $course->admin_assigned_at= now();

        if($course->save()){
            Log::info('Course created with admin tracking', [
                'course_id' => $course->id,
                'course_title' => $course->title,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name
            ]);
            return redirect('/dashboard');
        }
    }

    function addTopicView(Request $request){
        $admin = Session::get('admin');
        
       if($admin){
        $courses= Course::get();
           return view('add-topic',["name"=>$admin->name,'courses'=>$courses]);
       }else{
           return redirect('admin-login');
       }
    }

    function addTopic(Request $request){

        $validation = $request->validate([
            "title"=>"required | max:100 | min:10",
            "description"=>"required | max:500000 | min:100",
            "video_link"=>"required",
            "keywords"=>"required | max:500 | min:20",
        ], [
            'description.max' => 'The description field must not exceed 500,000 characters.',
            'description.min' => 'The description field must be at least 100 characters.',
        ]); 
        // return $request;
        $course = new Tutorial();
        $course->title= $request->title;
        $course->description= $request->description;
        $course->keywords= $request->keywords;
        $course->course_id= $request->course_id;
        $course->video_link= $request->video_link;
        if($course->save()){
            return redirect('/dashboard');
        }
    }

    function updateTopic(Request $request,$id){
         $id;
        //  return $request;
        $validation = $request->validate([
            "title"=>"required | max:100 | min:10",
            "description"=>"required | max:500000 | min:100",
            "video_link"=>"required",
            "keywords"=>"required | max:500 | min:20",
        ], [
            'description.max' => 'The description field must not exceed 500,000 characters.',
            'description.min' => 'The description field must be at least 100 characters.',
        ]); 
        // return $request;
        $topic =  Tutorial::find($id);
     
        if($topic){
           
            $topic->title= $request->title;
            $topic->description= $request->description;
            $topic->keywords= $request->keywords;
            $topic->course_id= $request->course_id;
            $topic->video_link= $request->video_link;
    
            if($topic->update()){
                return redirect('/admin-course');
            }
           }

       
    }

    function deleteTopic($id){
       $topic =  Tutorial::find($id)->delete();
       if($topic){
               return redirect('/admin-course');
          }
   }
    function topics($c_id){
      

       $admin = Session::get('admin');
        
       if($admin){
        $topics= Tutorial::where('course_id',$c_id)->get();
        return view('topics',['topics'=>$topics,"name"=>$admin->name]);
       }else{
           return redirect('admin-login');
       }

      }

      function editTopic($id){
        $admin = Session::get('admin');
        
        if($admin){
         $topic= Tutorial::find($id);
         $courses= Course::get();
        // return $topic->course_id;
 
         return view('edit-topic',['topic'=>$topic,"name"=>$admin->name,'courses'=>$courses]);
        }else{
            return redirect('admin-login');
        }
 
       }
      

      function course(){
       
        $admin = Session::get('admin');
        
        if($admin){
         $courses= Course::get();
         return view('admin-course',['courses'=>$courses,"name"=>$admin->name]);
        }else{
            return redirect('admin-login');
        }

       
       }

       /**
        * Course Analytics Dashboard - Track leads from each course
        */
       function courseAnalytics(Request $request) {
           $admin = Session::get('admin');
           
           if (!$admin) {
               return redirect('admin-login');
           }

           // Get courses with lead analytics
           $coursesWithAnalytics = Course::select('courses.*')
               ->withCount([
                   'signupLeads as total_signups',
                   'interestedLeads as interested_signups'
               ]);
               
           // Only load admin relationship if admin table exists
           if (Schema::hasTable('admin')) {
               $coursesWithAnalytics = $coursesWithAnalytics->with('createdByAdmin:id,name');
           }
           
           $coursesWithAnalytics = $coursesWithAnalytics
               ->orderBy('total_signups', 'desc')
               ->get()
               ->map(function ($course) {
                   $course->conversion_rate = $course->total_signups > 0 
                       ? round(($course->interested_signups / $course->total_signups) * 100, 2) 
                       : 0;
                   return $course;
               });

           // Get recent signups (last 30 days) per course
           $recentSignupsData = User::select('signup_source_course_id')
               ->selectRaw('COUNT(*) as recent_signups')
               ->where('created_at', '>=', now()->subDays(30))
               ->whereNotNull('signup_source_course_id')
               ->groupBy('signup_source_course_id')
               ->pluck('recent_signups', 'signup_source_course_id');

           // Add recent signup data to courses
           $coursesWithAnalytics = $coursesWithAnalytics->map(function ($course) use ($recentSignupsData) {
               $course->recent_signups = $recentSignupsData->get($course->id, 0);
               return $course;
           });

           // Get top performing courses by admin (skip if admins table doesn't exist)
           $adminPerformance = collect([]);
           
           try {
               // Check if admin table exists
               if (Schema::hasTable('admin')) {
                   $adminPerformance = Course::select('created_by_admin_id')
                       ->selectRaw('COUNT(DISTINCT courses.id) as total_courses')
                       ->selectRaw('SUM(CASE WHEN users.id IS NOT NULL THEN 1 ELSE 0 END) as total_leads')
                       ->selectRaw('SUM(CASE WHEN users.interested_in_training = "yes" THEN 1 ELSE 0 END) as interested_leads')
                       ->leftJoin('users', 'courses.id', '=', 'users.signup_source_course_id')
                       ->leftJoin('admin', 'courses.created_by_admin_id', '=', 'admin.id')
                       ->whereNotNull('courses.created_by_admin_id')
                       ->groupBy('courses.created_by_admin_id')
                       ->with('createdByAdmin:id,name')
                       ->get();
               }
           } catch (\Exception $e) {
               // If there's any error with admin queries, just skip it
               \Log::info('Admin performance query skipped: ' . $e->getMessage());
           }

           // Overall statistics
           $totalLeads = User::whereNotNull('signup_source_course_id')->count();
           $totalInterestedLeads = User::whereNotNull('signup_source_course_id')
               ->where('interested_in_training', 'yes')->count();
           $overallConversionRate = $totalLeads > 0 
               ? round(($totalInterestedLeads / $totalLeads) * 100, 2) 
               : 0;

           return view('course-analytics', [
               'name' => $admin->name,
               'courses' => $coursesWithAnalytics,
               'adminPerformance' => $adminPerformance,
               'totalLeads' => $totalLeads,
               'totalInterestedLeads' => $totalInterestedLeads,
               'overallConversionRate' => $overallConversionRate
           ]);
       }


    public function updateUserStatus(Request $request, $userId)
    {
        $request->validate([
            'user_status' => 'required|in:Not Interested,Interested,Joined,Follow up Required',
        ]);
        $user = User::findOrFail($userId);
        $user->user_status = $request->user_status;
        $user->save();
        return back()->with('success', 'User status updated successfully.');
    }
}

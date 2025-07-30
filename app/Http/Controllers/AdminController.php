<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            // Only users interested in training or leads
            $query->where(function($q) {
                $q->where('interested_in_training', 'yes')
                  ->orWhere('leads', 1);
            });
            // Search
            $search = $request->input('search');
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhere('mobile', 'like', "%$search%")
                      ->orWhere('passing_year', 'like', "%$search%")
                      ->orWhere('interested_in_training', 'like', "%$search%")
                      ->orWhere('leads', 'like', "%$search%")
                      ->orWhere('user_status', 'like', "%$search%") ;
                });
            }
            // Sorting
            $sort = $request->input('sort', 'id');
            $direction = $request->input('direction', 'desc');
            $allowedSorts = ['id','name','email','mobile','passing_year','interested_in_training','leads','user_status'];
            if (!in_array($sort, $allowedSorts)) $sort = 'id';
            if (!in_array($direction, ['asc','desc'])) $direction = 'desc';
            $query->orderBy($sort, $direction);
            // Pagination
            $users = $query->paginate(10)->appends($request->all());
            return view('admin', [
                "name" => $admin->name,
                'users' => $users,
                'search' => $search,
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
        $quizData=Quiz::where('category_id',$id)->get();
           return view('quiz-list',["name"=>$admin->name,"quizData"=>$quizData,'category'=>$category]);
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
        $course = new Course();
        $course->title= $request->title;
        $course->description= $request->description;

        if($course->save()){
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
            "description"=>"required | max:5000 | min:100",
            "video_link"=>"required",
            "keywords"=>"required | max:500 | min:20",
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

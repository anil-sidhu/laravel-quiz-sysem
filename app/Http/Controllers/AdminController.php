<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;



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

    function dashboard(){
        $admin = Session::get('admin');
        if($admin){
            $users= User::orderBy('id','desc')->paginate(10);
            return view('admin',["name"=>$admin->name,'users'=>$users]);
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
}

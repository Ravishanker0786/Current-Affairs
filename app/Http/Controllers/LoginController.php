<?php

namespace App\Http\Controllers;
use App\Login;
use App\News;
use App\Topic;
use App\Quiz;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function check_login(Request $request){
        $pass = $request->pass ?? '';
        $login = Login::where('pass',$pass)->first();
        if ($login) {
            return ['response' => 'ok'];
        }else{
            return ['response' => 'error'];
        }
    }

    public function checklogin(Request $request){
        $validatedData = $request->validate([
             'username' => 'required',
             'password' => 'required',
        ]);
        $requestData = $request->all();

        $find_user = User::where('username', '=' , $requestData['username'])
                    ->where('status', 1)
                    ->first();

        if($find_user){
            $guard_type = $find_user->user_type;
            if($guard_type=='admin'){
                $guard_type='';
            }

            if (Auth::guard($guard_type)->attempt(['username' => $requestData['username'], 'password' => $requestData['password'], ])) {
                if($find_user->user_type=='admin'){
                  return ['status' => 'success', 'redirect' => url('admin/dashboard')];
                }else {
                    return ['status' => 'fail', 'redirect' => '', 'msg' =>'Invalid Login'];
                }

            }else{
                return ['status' => 'fail', 'redirect' => '', 'msg' =>'Invalid Login'];
            }
        }else{
              return ['status' => 'fail', 'redirect' => '', 'msg' =>'Your record not found or login disable'];


        }
    }


    public function after_login(Request $request){
        $news_count = News::all()->count();
        $topic_count = Topic::all()->count();
        $quiz_count = Quiz::groupBy('qno')->get()->count();
        return view('welcome',['news_count' => $news_count,'topic_count' => $topic_count,'quiz_count' => $quiz_count]);
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}

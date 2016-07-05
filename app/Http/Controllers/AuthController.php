<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Auth;
use App\User;
use App\Admin;
use App\Teacher;

class AuthController extends Controller {

	//返回firstpage(首页)，即登录页面
	public function firstpage()
	{
		return view('login');
	}

	//登录的身份认证
	public function login(Request $request)
	{
		$userID = $request->get('userID');
		$password = $request->get('password');

		if(Auth::attempt(['userID' => $userID, 'password' => $password]))
		{
			if(Auth::user()->isAdmin)
			{
				$admin = Admin::where(['adminID' => $userID, 'password' => $password]);
				return response()->json(['status'=>1, 'role'=>'admin', 'userID'=>$userID]);
				//return json_encode(['status'=>1, 'role'=>'admin', 'userID'=>$userID]);
			}
			elseif(Auth::user()->isTeacher)
			{
				$teacher = Teacher::where(['teacherID' => $userID, 'password' => $password]);
				return response()->json(['status'=>1, 'role'=>'teacher', 'userID'=>$userID]);
			}
			elseif(Auth::user()->isStudent)
			{
				$student = Student::where(['studentID' => $userID, 'password' => $password]);
				return response()->json(['status'=>1, 'role'=>'student', 'userID'=>$userID]);
			}
		}
		else
		{
			return response()->json(['status'=>0, 'role'=>'', 'userID'=>'']);
		}
	}

	public function check()
	{
		return redirect('firstpage');
	}

}

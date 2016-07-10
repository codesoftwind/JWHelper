<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Hash;
use Auth;
use App\User;
use App\Admin;
use App\Teacher;
use App\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AuthController extends Controller {

	//返回firstpage(首页)，即登录页面
	public function login()
	{
		return view('login');
	}
	

	//登录的身份认证
	public function authLogin(Request $request)
	{
		$userID = $request->get('userID');
		$password = $request->get('password');

		if(Auth::attempt(['userID' => $userID, 'password' => $password]))
		{
			if(Auth::user()->isAdmin)
			{
				$admin = DB::table('admins')->select('adminName')->where('adminID', $userID)->get();
				session(['userID'=>$userID, 'role'=>'教务管理员', 'username'=>$admin[0]->adminName]);
				return response()->json(['status'=>1, 'role'=>'admin', 'userID'=>$userID]);
			}
			elseif(Auth::user()->isTeacher)
			{
				$teacher = DB::table('teachers')->select('teacherName')->where('teacherID', $userID)->get();
				session(['userID'=>$userID, 'role'=>'教师', 'username'=>$teacher[0]->teacherName]);
				return response()->json(['status'=>1, 'role'=>'teacher', 'userID'=>$userID]);
			}
			elseif(Auth::user()->isStudent)
			{
				$student = DB::table('students')->select('studentName')->where('studentID', $userID)->get();
				session(['userID'=>$userID, 'role'=>'学生', 'username'=>$student[0]->studentName]);
				return response()->json(['status'=>1, 'role'=>'student', 'userID'=>$userID]);
			}
		}
		else
		{
			return response()->json(['status'=>0, 'role'=>'', 'userID'=>'']);
		}
	}

	/**
	 * 注销用户登录
	 */
	public function logout()
	{
		Session::forget('userID');
		Session::forget('username');
		Session::forget('role');
		Session::forget('lessonID');
		Session::forget('thomeworkID');
		Auth::logout();
		return redirect('login');
	}

	public function nopage()
	{
		if(!Auth::check())
			return redirect('login');

		return view('view.template.no-page');
	}

}

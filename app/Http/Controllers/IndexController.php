<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Session;

class IndexController extends Controller {

	/**
	 * 同一的index路由，在这里再根据role重定向到具体的角色的index路由
	 */
	public function index()
	{
		if(!Auth::check())
			return redirect('login');

		if(session('role') == '教务管理员')
		{
			return redirect('admin/index');
		}
		elseif(session('role') == '教师')
		{
			return redirect('teacher/index');
		}
		elseif(session('role') == '学生')
		{
			return redirect('student/index');
		}
	}

}

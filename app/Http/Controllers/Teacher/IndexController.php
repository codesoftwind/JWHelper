<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class IndexController extends Controller {

	/**
	 * 显示教师首页，由于默认是显示教师的课程列表，所以重定向到显示课程列表的路由
	 */
	public function index()
	{
		if(!Auth::check())
			return redirect('login');

		return redirect('teacher/lessonsList');
	}

	

}

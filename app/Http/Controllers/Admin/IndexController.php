<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class IndexController extends Controller {

	/**
	 * 显示教务首页，默认显示课程列表
	 */
	public function index()
	{
		if(!Auth::check())
			return redirect('login');

		$adminID = Auth::user()->userID;

		//需要注意的是select返回的是包含对象的数组，对象的属性就是我们select的列
		$admin = DB::table('admins')
								->select('adminName')
								->where('adminID', $adminID)		
								->get();
		$tmpresult = DB::table('tlessons')
								->join('lessons', 'tlessons.lessonID', '=', 'lessons.lessonID')
								->join('teachers', 'tlessons.teacherID', '=', 'teachers.teacherID')
								->select('lessons.lessonID', 'lessons.lessonName', 'teachers.teacherID', 'teachers.teacherName')
								->get();
		$result = ['title'=>'课程列表', 'username'=>$admin[0]->adminName, 'role'=>'教务管理员', 'result'=>$tmpresult];
		return view('view.admin.index')->with($result);
	}
	

}

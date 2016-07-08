<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class LessonController extends Controller {
	
	/**
	 * 教师查看课程列表，返回view并加上该教师所教课程的数组
	 */
	public function lessonsList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = Auth::user()->userID;
		$tmpresult = DB::table('lessons')
								->join('tlessons', 'tlessons.lessonID', '=', 'lessons.lessonID')
								->select('lessons.lessonID', 'lessons.lessonName')
								->where('tlessons.teacherID', $teacherID)
								->get();
		$result = ['title'=>'课程列表', 'username'=>session('username'), 'role'=>session('role'), 'result'=>$tmpresult];
		return view('view.teacher.index')->with($result);
	}

	/**
	 * 显示课程的详情信息
	 */
	public function lesson(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		
		$lessonID = $request->get('lessonID');

		$tmpresult = DB::table('lessons')
								->select('lessonID', 'lessonName', 'introduction')
								->where('lessonID', $lessonID)
								->get();

		$result = ['title'=>'课程详情', 'username'=>session('username'), 'role'=>session('role'), 'result'=>$tmpresult];

		return view('view.teacher.classinfo')->with($result);
	}
	
}

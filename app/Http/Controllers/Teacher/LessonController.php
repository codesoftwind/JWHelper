<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use DB;

class LessonController extends Controller {
	
	/**
	 * 教师查看课程列表，返回给前端该教师所教课程的数组
	 */
	public function lessonsList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = Auth::user()->userID;
		$result = DB::table('lessons')
								->join('tlessons', 'tlessons.lessonID', '=', 'lessons.lessonID')
								->select('lessons.lessonID', 'lessons.lessonName')
								->where('tlessons.teacherID', $teacherID)
								->get();
		return response()->json($result);
	}

	public function lesson()
	{
		
	}

	

}

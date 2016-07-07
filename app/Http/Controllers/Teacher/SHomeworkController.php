<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SHomeworkController extends Controller {

	/**
	 * 教师查看学生提交的作业的详请
	 */
	public function shomework(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$shomeworkID = $request->get('shomeworkID');
		$group = $request->get('group');

		//判断是团队作业还是个人作业
		if($group)
		{
			$shomework = DB::table('shomeworks')
						->join('lessons', 'lessons.lessonID', '=', 'shomeworks.lessonID')
						->join('groups', 'groups.groupID', '=', 'shomeworks.groupID')
						->select('lessons.lessonID', 'lessons.lessonName', 'shomeworks.shomeworkID', 'shomeworks.content', 'shomeworks.attachment', 'groups.groupName')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get();

			$thomework = DB::table('shomeworks')
						->join('thomeworks', 'shomeworks.thomeworkID', '=', 'thomeworks.thomeworkID')
						->select('thomeworks.thomeworkName', 'thomeworks.description')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get(); 
		}
		else
		{
			$shomework = DB::table('shomeworks')
						->join('lessons', 'lessons.lessonID', '=', 'shomeworks.lessonID')
						->join('students', 'students.studentID', '=', 'shomeworks.studentID')
						->select('lessons.lessonID', 'lessons.lessonName', 'shomeworks.shomeworkID', 'shomeworks.content', 'shomeworks.attachment', 'students.studentID', 'students.studentName')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get();

			$thomework = DB::table('shomeworks')
						->join('thomeworks', 'shomeworks.thomeworkID', '=', 'thomeworks.thomeworkID')
						->select('thomeworks.thomeworkName', 'thomeworks.description')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get(); 
		}

		$result = ['title'=>'学生作业', 'username'=>session('username'), 'role'=>session('role'), '$shomework'=>$shomework, 'thomework'=>$thomework];
	
		return view()->with($result);
	}


	public function shomeworkDownload()
	{

	}

	/**
	 * 教师为学生的作业打分并评论
	 */
	public function shomeworkRate(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$shomeworkID = $request->get('shomeworkID');
		$grade = $request->get('grade');
		$comment = $request->get('comment');

		$success = DB::table('shomeworks')
								->where('shomeworkID', $shomeworkID)
								->update(array('grade'=>$grade, 'comment'=>$comment));

		if($success)
			return response()->json(['status'=>1]);
		else
			return response()->json(['status'=>0]);
	}
	

}

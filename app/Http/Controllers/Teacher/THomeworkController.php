<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class THomeworkController extends Controller {

	/**
	 * 教师查看作业列表
	 */
	public function thomeworksList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$lessonID = session('lessonID');
		$teacherID = session('userID');

		$thomework = DB::table('thomeworks')
									->join('lessons', 'lessons.lessonID', '=', 'thomeworks.lessonID')
									->where('thomeworks.teacherID', $teacherID)
									->where('thomeworks.lessonID', $lessonID)
									->select('thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'lessons.lessonName', 'thomeworks.startTime', 'thomeworks.endTime')
									->get();

		$result = ['title'=>'作业列表', 'username'=>session('username'), 'role'=>session('role'), 'result'=>$thomework];
		
		return view('view.teacher.homework')->with($result);
	}


	/**
	 * 教师布置作业
	 */
	public function thomeworkPublish(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = session('userID');
		$lessonID = $request->get('lessonID');
		$thomeworkName = $request->get('thomeworkName');
		$description = $request->get('description');
		$startTime = $request->get('startTime');
		$endTime = $request->get('endTime');
		$group = $request->get('group');

		$success = DB::table('thomeworks')->insert(
			array('teacherID'=>$teacherID, 'lessonID'=>$lessonID, 'thomeworkName'=>$thomeworkName, 'description'=>$description,
				'startTime'=>$startTime, 'endTime'=>$endTime, 'group'=>$group));

		if($success)
			return response()->json(['status'=>1]);
		else
			return response()->json(['status'=>0]);

	}


	/**
	 * 教师查看自己布置的作业的详情，同时会显示已提交的作业列表
	 */
	public function thomework(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$thomeworkID = $request->get('thomeworkID');

		$thomework = DB::table('thomeworks')
									->join('lessons', 'lessons.lessonID', '=', 'thomeworks.lessonID')
									->select('thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'lessons.lessonID', 'lessons.lessonName', 'thomeworks.description', 'thomeworks.startTime', 'thomeworks.endTime', 'thomeworks.group')
									->where('thomeworks.thomeworkID', $thomeworkID)
									->get();
        
        //判断是团队作业还是个人作业
		if($thomework[0]->group)
		{
			$shomework = DB::table('shomeworks')
									->join('groups', 'groups.groupID', '=', 'shomeworks.groupID')
									->select('shomeworks.grade', 'shomeworks.shomeworkID', 'groups.groupName', 'groups.headID', 'groups.headName')
									->where('shomeworks.thomeworkID', $thomeworkID)
									->get();

			$group = true;
		}
		else
		{
			$shomework = DB::table('shomeworks')
									->join('students', 'students.studentID', '=', 'shomeworks.studentID')
									->select('shomeworks.grade', 'shomeworks.shomeworkID', 'students.studentID', 'students.studentName')
									->where('shomeworks.thomeworkID', $thomeworkID)
									->get();

			$group = false;
		}

		$result = ['title'=>'作业详情', 'username'=>session('username'), 'role'=>session('role'), 'thomework'=>$thomework, 'shomework'=>$shomework, 'group'=>$group];

		return view('view.teacher.homework')->with($result);
	}

}

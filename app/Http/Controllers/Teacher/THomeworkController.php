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
	public function homeworksList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$lessonID = $request->get('lessonID');
		$teacherID = session('userID');

		$thomework = DB::table('thomeworks')
									->join('lessons', 'lessons.lessonID', '=', 'thomeworks.lessonID')
									->where('thomeworks.teacherID', $teacherID)
									->where('thomeworks.lessonID', $lessonID)
									->select('thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'lessons.lessonName', 'thomeworks.startTime', 'thomeworks.endTime')
									->get();

		$result = ['title'=>'作业列表', 'username'=>session('username'), 'role'=>session('role'), 'thomework'=>$thomework];
		
		return view('view.teacher.homework')->with($result);
	}


	/**
	 * 教师布置作业
	 */
	public function homeworkPublish(Request $request)
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
	public function homework(Request $request)
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

		return view()->with($result);
	}


	/**
	 * 教师查看学生提交的作业的详请
	 */
	public function stuHomework(Request $request)
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


	/**
	 * 教师下载学生作业的附件
	 */
	public function stuHomeworkDownload()
	{

	}


	/**
	 * 教师为学生的作业打分并评论
	 */
	public function stuHomeworkRate(Request $request)
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

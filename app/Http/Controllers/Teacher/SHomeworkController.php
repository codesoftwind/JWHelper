<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

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
						->select('lessons.lessonID', 'lessons.lessonName', 'shomeworks.shomeworkID', 'shomeworks.content', 'shomeworks.attachment', 'shomeworks.attachmentName', 'shomeworks.grade', 'shomeworks.comment', 'groups.groupName')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get();

			$thomework = DB::table('shomeworks')
						->join('thomeworks', 'shomeworks.thomeworkID', '=', 'thomeworks.thomeworkID')
						->select('thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'thomeworks.description')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get(); 
		}
		else
		{
			$shomework = DB::table('shomeworks')
						->join('lessons', 'lessons.lessonID', '=', 'shomeworks.lessonID')
						->join('students', 'students.studentID', '=', 'shomeworks.studentID')
						->select('lessons.lessonID', 'lessons.lessonName', 'shomeworks.shomeworkID', 'shomeworks.content', 'shomeworks.attachment', 'shomeworks.attachmentName', 'shomeworks.grade', 'shomeworks.comment', 'students.studentID', 'students.studentName')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get();

			$thomework = DB::table('shomeworks')
						->join('thomeworks', 'shomeworks.thomeworkID', '=', 'thomeworks.thomeworkID')
						->select('thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'thomeworks.description')
						->where('shomeworks.shomeworkID', $shomeworkID)
						->get(); 
		}

		$result = ['title'=>'学生作业', 'username'=>session('username'), 'role'=>session('role'), 'group'=>$group, 'shomework'=>$shomework, 'thomework'=>$thomework];
	
		return view('view.teacher.shomeworkRate')->with($result);
	}


	/**
	 * 教师为学生的作业打分并评论
	 */
	public function shomeworkRate(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		if(empty($request->get('grade')))
			return response()->json(['status'=>0, 'descrip'=>'分数不能为空，请输入分数']);
		
		$shomeworkID = $request->get('shomeworkID');	
		$comment = $request->get('comment');
		$grade = (int)$request->get('grade');
		
		if($grade < 0 or $grade > 100)
			return response()->json(['status'=>0, 'descrip'=>'请输入正确的分数']);

		$success = DB::table('shomeworks')
								->where('shomeworkID', $shomeworkID)
								->update(array('grade'=>$grade, 'comment'=>$comment));

		if($success)
			return response()->json(['status'=>1, 'descrip'=>'评分成功']);
		else
			return response()->json(['status'=>0, 'descrip'=>'评分失败，数据库操作失败']);
	}
	

}

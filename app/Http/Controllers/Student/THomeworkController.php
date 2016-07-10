<?php namespace App\Http\Controllers\Student;

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
	 * 学生查看某一门课的作业列表
	 */
	public function thomeworksList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = $request->get('teacherID');
		$lessonID = $request->get('lessonID');
		$studentID = session('userID');

		$thomeworks = DB::table('thomeworks')
						->select('thomeworkID', 'thomeworkName', 'startTime', 'endTime', 'group')
						->where('teacherID', $teacherID)
						->where('lessonID', $lessonID)
						->get();

		$shomeworks = array();

		foreach ($thomeworks as $thomework) 
		{
			$group = $thomework->group;

			//判断是否是团队作业
			if($group)
			{
				$tmp = DB::table('shomeworks')
						->join('groups', 'shomeworks.groupID', '=', 'groups.groupID')
						->join('sgroups', 'sgroups.groupID', '=', 'groups.groupID')
						->select('shomeworks.shomeworkID', 'shomeworks.grade', 'shomeworks.content', 'shomeworks.attachment')
						->where('shomeworks.thomeworkID', $thomework->thomeworkID)
						->where('sgroups.studentID', $studentID)
						->get();

				array_push($shomeworks, $tmp);
			}
			else
			{
				$tmp = DB::table('shomeworks')
						->join('students', 'shomeworks.studentID', '=', 'students.studentID')
						->select('shomeworks.shomeworkID', 'shomeworks.grade', 'shomeworks.content', 'shomeworks.attachment')
						->where('shomeworks.thomeworkID', $thomework->thomeworkID)
						->where('shomeworks.studentID', $studentID)
						->get();

				array_push($shomeworks, $tmp);
			}
		}

		$result = ['title'=>'作业列表', 'username'=>session('username'), 'role'=>session('role'), 'thomeworks'=>$thomeworks, 'shomeworks'=>$shomeworks];

		return view('view.student.teacherworks')->with($result);
	}

}

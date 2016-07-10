<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;


class GroupController extends Controller {

	/**
	 * 教师查看已加入某门课程的团队列表
	 */
	public function groupsInList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = session('userID');
		$lessonID = session('lessonID');
		
		$groups = DB::table('tsgroups')
						->join('groups', 'groups.groupID', '=', 'tsgroups.groupID')
						->select('tsgroups.lessonID', 'groups.groupID', 'groups.groupName', 'groups.headID', 'groups.headName')
						->where('tsgroups.teacherID', $teacherID)
						->where('tsgroups.lessonID', $lessonID)
						->get();

		$backPage = 'in';

		$result = ['title'=>'已加入课程的团队', 'username'=>session('username'), 'role'=>session('role'), 'groups'=>$groups, 'backPage'=>$backPage];

		return view('view.teacher.groupList')->with($result);
	}


	/**
	 * 教师查看待审核的团队列表
	 */
	public function groupsIOList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = session('userID');
		$lessonID = session('lessonID');

		$groups = DB::table('tschecks')
						->join('groups', 'tschecks.groupID', '=', 'groups.groupID')
						->select('tschecks.lessonID', 'groups.groupID', 'groups.groupName', 'groups.headID', 'groups.headName')
						->where('tschecks.teacherID', $teacherID)
						->where('tschecks.lessonID', $lessonID)
						->where('status', 0)
						->get();

		$backPage = 'io';

		$result = ['title'=>'待审核的团队', 'username'=>session('username'), 'role'=>session('role'), 'groups'=>$groups, 'backPage'=>$backPage];

		return view('view.teacher.groupList')->with($result);
	}	


	/**
	 * 教师查看审核被拒的团队列表
	 */
	public function groupsOutList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = session('userID');
		$lessonID = session('lessonID');

		$groups = DB::table('tschecks')
						->join('groups', 'tschecks.groupID', '=', 'groups.groupID')
						->select('tschecks.lessonID', 'groups.groupID', 'groups.groupName', 'groups.headID', 'groups.headName')
						->where('tschecks.teacherID', $teacherID)
						->where('tschecks.lessonID', $lessonID)
						->where('tschecks.status', 1)
						->get();

		$backPage = 'out';

		$result = ['title'=>'审核被拒的团队', 'username'=>session('username'), 'role'=>session('role'), 'groups'=>$groups, 'backPage'=>$backPage];
	
		return view('view.teacher.groupList')->with($result);
	}


	/**
	 * 教师查看团队的详细信息
	 */
	public function group(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$groupID = $request->get('groupID');
		//backPage和lessonID用于返回按钮
		$backPage = $request->get('backPage');
		$lessonID = session('lessonID');

		$group = DB::table('groups')
					->select('groupName', 'groupID', 'headID', 'headName')
					->where('groupID', $groupID)
					->get();

		$groupMembers = DB::table('groups')
					->join('sgroups', 'groups.groupID', '=', 'sgroups.groupID')
					->join('students', 'sgroups.studentID', '=', 'students.studentID')
					->select('students.studentID', 'students.studentName')
					->where('groups.groupID', $groupID)
					->get();

		$result = ['title'=>'团队详情', 'username'=>session('username'), 'role'=>session('role'), 'group'=>$group, 'groupMembers'=>$groupMembers, 'backPage'=>$backPage]; 

		return view('view.teacher.groupcheck')->with($result);
	}


	/**
	 * 教师查看团队详细信息之后返回上一级页面
	 */
	public function backPage(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$lessonID = session('lessonID');
		$teacherID = session('userID');
		$backPage = $request->get('backPage');

		if($backPage == 'in') //返回已经在课程中的团队列表
			return redirect('teacher/groupsInList');
		elseif ($backPage == 'io') //返回待审核团队列表
			return redirect('teacher/groupsIOList');
		elseif ($backPage == 'out') //返回审核被拒的团队列表
			return redirect('teacher/groupsOutList');
	}



	/**
	 * 教师审核团队申请进入课程
	 */
	public function groupCheck(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = session('userID');
		$lessonID = session('lessonID');
		$groupID = (int)$request->get('groupID');
		$judge = (int)$request->get('judge');

		//说明老师拒绝了该团队加入课程的申请
		if($judge == 0)
		{
			$success = DB::table('tschecks')
							->where('teacherID', $teacherID)
							->where('lessonID', $lessonID)
							->where('groupID', $groupID)
							->update(array('status'=>1));

			if($success)
				return response()->json(['status'=>1, 'descrip'=>'拒绝申请成功']);
			else
				return response()->json(['status'=>0, 'descrip'=>'拒绝申请失败，数据库操作失败']);
		}

		//下面判断申请加入课程的团队中是否有人在其他加入本课程的团队中
		
		//这是已经通过团队加入课程的学生ID的集合
		$tmpdata = DB::table('tsgroups')
							->join('sgroups', 'tsgroups.groupID', '=', 'sgroups.groupID')
							->select('sgroups.studentID')
							->where('tsgroups.teacherID', $teacherID)
							->where('tsgroups.lessonID', $lessonID)
							->get();

		$inID = array();
		foreach($tmpdata as $data) 
		{
			$inID[] = $data->studentID;
		}

		$tmpdata = DB::table('sgroups')
							->where('groupID', $groupID)
							->whereIn('studentID', $inID)
							->get();

		//说明有学生已经在某个加入课程的团队中了
		if(count($tmpdata) > 0)
			return response()->json(['status'=>0, 'descrip'=>'同意申请失败，该组的某个学生已经在某个加入课程的团队中了']);

		//到这步，说明是同意申请，并且团队满足要求
		$success1 = DB::table('tsgroups')
							->insert(array('teacherID'=>$teacherID, 'lessonID'=>$lessonID, 'groupID'=>$groupID));

		$success2 = DB::table('tschecks')
							->where('teacherID', $teacherID)
							->where('lessonID', $lessonID)
							->where('groupID', $groupID)
							->update(array('status'=>2));

		if($success1 and $success2)
			return response()->json(['status'=>1, 'descrip'=>'同意申请成功']);
		else
			return response()->json(['status'=>0, 'descrip'=>'同意申请失败，数据库操作失败']);
	}

}

<?php namespace App\Http\Controllers\Student;

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
	 * 显示学生加入了得团队和所有的团队
	 */
	public function groupsList()
	{
		if(!Auth::check())
			return redirect('login');

		$studentID = session('userID');

		//学生已经加入的团队
		$ingroups = DB::table('groups')
							->join('sgroups', 'groups.groupID', '=', 'sgroups.groupID')
							->select('groups.groupID', 'groups.groupName', 'groups.headID', 'groups.headName', 'groups.maxPeople', 'groups.occupied')
							->where('sgroups.studentID', $studentID)
							->get();

		//学生还未加入的团队
		$outgroups = DB::table('groups')
							->join('sgroups', 'groups.groupID', '=', 'sgroups.groupID')
							->select('groups.groupID', 'groups.groupName', 'groups.headID', 'groups.headName', 'groups.maxPeople', 'groups.occupied')
							->where('sgroups.studentID', '!=', $studentID)
							->get();

		$result = ['title'=>'参加的团体列表', 'username'=>session('username'), 'role'=>session('role'), 'ingroups'=>$ingroups, 'outgroups'=>$outgroups];
		
		return view('view.student.group')->with($result);
	}

	/**
	 * 学生组建一个团体
	 */
	public function groupForm(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$groupName = $request->get('groupName');
		$maxPeople = $request->get('maxPeople');
		$headID = session('userID');
		$username = session('username');

		//insertGetId()返回刚刚插入的记录的自增字段的值
		$groupID = DB::table('groups')
								->insertGetId(array('groupName'=>$groupName, 'maxPeople'=>$maxPeople, 'headID'=>$headID, 'headName'=>$username, 'occupied'=>1));
		
		if($groupID)
		{
			//insert()返回一个bool值，表示是否插入成功
			$insertsgroups = DB::table('sgroups')
								->insert(array('groupID'=>$groupID, 'studentID'=>$headID));
			if($insertsgroups)
				return response()->json(['status'=>1]);
		}

		return response()->json(['status'=>0]);
	}
}

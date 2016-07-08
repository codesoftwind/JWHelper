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
	public function groupsList()	 */
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

	public function myGroups(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		$res=DB::select('select * from groups where headID =?',[session('userID')]);
		$myGroups=array();
		foreach($res as $data)
		{
			$count = DB::table('sapply')
			         ->where('groupID','=',$data->groupID)
			         ->distinct()
			         ->count();
			array_push($myGroups, ['group'=>$data,'applyCount'=>$count]);
		}

	    $result = ['title'=>'我的团队', 'username'=>session('username'), 'myGroups'=>$myGroups,'role'=>session('role')];

	}



	public function toApply(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
        $res=DB:table('groups')->join('sgroups','groups.groupID','=','sgroups.groupID')
        	->select('groups.groupID', 'groups.groupName', 'groups.headID', 'groups.headName', 'groups.maxPeople', 'groups.occupied')
      		->where('sgroups.studentID','!=',session('userID'))
      		->distinct();  	
        $toApply=array();
        foreach($res as $data)
        {
        	$status=DB::select("select * from scheck where studentID=? and groupID =? and status=?",
        		[session('userID'),$data->groupID,0]);
        	$has=0;
        	if(count($status)!=0)
        		$has=1;
         	array_push($toApply, ['apply'=>$data,'status'=>$has]);
        }

        $result = ['title'=>'可申请的团队列表', 'username'=>session('username'), 'toApply'=>$toApply,'role'=>session('role')];


	}


	public function apply(Request $request)
	{
		if(!Auth::check())
			return redirect("login");
		DB::insert("insert into sapply values(?,?)",[session('userID'),$request->groupID]);

        $headID=DB::select("select headID from groups where groupID = ?",[$request->groupID])[0]->headID;
		DB::insert("insert into scheck values(?,?,?,?,?)",
			[session('userID'),session('username'),$request->groupID,$headID,0]);

		return view('',['title'=>'可加入的团队','username'=>session('username'),'role'=>session('role')
			,'']);
	}

	public function checkList(Request $request)
	{

		if(Auth::check())
			return redirect('login');
		DB::select("select * from scheck where headID =? and status =0",[session('userID')]);

	}
	public function check(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		DB::update("update scheck set status = 1 where studentID =? and groupID =?",
			[$request->studentID,$request->groupID]);
	}

}

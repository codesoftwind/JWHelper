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

		$result = ['title'=>'参加的团体列表', 'username'=>session('username'), 'role'=>session('role'), 'ingroups'=>$ingroups
		];
		
		
		return view('view.student.inGroup')->with($result);
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
			$count = DB::table('schecks')
			         ->where('groupID','=',$data->groupID)
			         ->where('status','=',0)
			         ->distinct()
			         ->count();
			array_push($myGroups, ['group'=>$data,'applyCount'=>$count]);
		}

	    $result = ['title'=>'我的团队', 'username'=>session('username'), 'myGroups'=>$myGroups,'role'=>session('role')];

		return view ('view.student.myGroup', $result);
	}



	public function toApply(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
        $res=DB::table('groups')->join('sgroups','groups.groupID','=','sgroups.groupID')
            ->select('groups.groupID', 'groups.groupName', 'groups.headID','sgroups.studentID', 'groups.headName', 'groups.maxPeople', 'groups.occupied')
      	    ->where('sgroups.studentID','!=',session('userID'))	
      		->get();  	
      	//return session('userID');
        $toApply=array();
        //return count($res);
        foreach($res as $data)
        {
        	$status=DB::select("select * from schecks where studentID=? and groupID =? and status!=?",
        		[session('userID'),$data->groupID,2]);
        	if(count($status)!=0)
        	{
        		array_push($toApply, ['apply'=>$data,'status'=>1]);
        	}
        	else
        		array_push($toApply, ['apply'=>$data,'status'=>0]);


         	
        }

        $result = ['title'=>'可申请的团队列表', 'username'=>session('username'), 'toApply'=>$toApply,'role'=>session('role')];
        return view('view.student.outGroup',$result);
	}


	public function apply(Request $request)
	{
		if(!Auth::check())
			return redirect("login");
		DB::insert("insert into sapplys values(?,?)",[session('userID'),$request->groupID]);

        $headID=DB::select("select headID from groups where groupID = ?",[$request->groupID])[0]->headID;
		DB::insert("insert into schecks values(?,?,?,?,?)",
			[session('userID'),session('username'),$request->groupID,$headID,0]);

		return ['status'=>1];
	}

	public function checkList(Request $request)
	{

		if(!Auth::check())
			return redirect('login');

		$checkList=DB::table('groups')->join('schecks','groups.headID','=','schecks.headID')
		     ->where('schecks.status','=',0)
		     ->where('groups.headID','=',session('userID'))
		    
		     ->get();
		return view('view.student.checkGroup',['title'=>'待审核的申请列表', 'username'=>session('username'),'role'=>session('role'),'checkList'=>$checkList]);


	}
	public function check(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		$agree=$request->agree;
		$agree++;
		DB::update("update schecks set status = ? where studentID =? and groupID =?",
			[$agree,$request->studentID,$request->groupID]);
		if($agree==2)
		{
			DB::insert("insert into sgroups (studentID,groupID) values(?,?)",
		          [$request->studentID,$request->groupID]);
       		DB::update("update groups set occupied = occupied+1 where groupID =",[$request->groupID]);
       	}

		return ['status'=>1];
	}

}

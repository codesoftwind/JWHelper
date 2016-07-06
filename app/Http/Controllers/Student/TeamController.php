<?php namespace App\Http\Controllers\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class TeamController extends Controller {

	/**
	 * 学生显示其加入的所有的团队的列表
	 */
	public function teamsList()
	{
		if(!Auth::check())
			return redirect('login');

		$studentID = session('userID');
		$group = DB::table('groups')
							->join('sgroups', 'groups.groupID', '=', 'sgroups.groupID')
							->select('groups.groupID', 'groups.groupName')
							->where('sgroups.studentID', $studentID)
							->get();
		$result = ['title'=>'参加的团体列表', 'userName'=>session('userName'), 'role'=>session('role'), 'result'=>$group];
		return view()->with($result);
	}

	/**
	 * 学生组建团体
	 */
	public function teamForm(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$groupName = $request->get('groupName');
		$maxPeople = $request->get('maxPeople');
		
	}
}

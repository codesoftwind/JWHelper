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
	 * 教师查看某门课程的团队列表
	 */
	public function groupsList()
	{
		if(!Auth::check())
			return redirect('login');

		
	}

	/**
	 * 教师审核团队申请进入课程
	 */
	public function groupCheck(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = session('userID');
		$lessonID = $request->get('lessonID');
		$groupID = $request->get('groupID');

		$success = DB::table('tsgroups')
							->insert(array('teacherID'=>$teacherID, 'lessonID'=>$lessonID, 'groupID'=>$groupID));

		if($success)
			return ['status'=>1];
		else
			return ['status'=>0];
	}

}

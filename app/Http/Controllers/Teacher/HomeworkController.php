<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class HomeworkController extends Controller {

	/**
	 * 教师查看作业列表
	 */
	public function homeworksList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$lessonID = $request->get('lessonID');
		$teacherID = session('userID');

		$tmpresult = DB::table('pubhomework')
									->where('teacherID', $teacherID)
									->where('lessonID', $lessonID)
									->select('homeworkID', 'homeworkName')
									->get();

		$result = ['title'=>'布置作业列表', 'username'=>session('username'), 'role'=>session('role'), 'result'=>$tmpresult];
		
		return view('view.teacher.homework')->with($result);
	}

	/**
	 * 教师布置作业
	 */
	public function homeworkPublish(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$teacherID = Auth::user()->userID;
		$lessonID = $request->get('lessonID');
		$homeworkName = $request->get('homeworkName');
		$description = $request->get('description');
		$startTime = $request->get('startTime');
		$endTime = $request->get('endTime');
		$team = $request->get('team');

		$success = DB::table('pubhomework')->insert(
			array('teacherID'=>$teacherID, 'lessonID'=>$lessonID, 'homeworkName'=>$homeworkName, 'description'=>$description,
				'startTime'=>$startTime, 'endTime'=>$endTime, 'team'=>$team));

		if($success)
			return response()->json(['status'=>1]);
		else
			return response()->json(['status'=>0]);

	}

	/**
	 * 教师查看自己布置的作业的详情
	 */
	public function homework()
	{

	}
	

}

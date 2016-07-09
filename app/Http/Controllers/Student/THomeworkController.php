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

		$thomeworks = DB::table('thomeworks')
						->join('shomeworks', 'thomeworks.thomeworkID', '=', 'shomeworks.thomeworkID')
						->select('thomeworks.thomeworkName', 'thomeworks.startTime', 'thomeworks.endTime', 'shomeworks.content', 'shomeworks.attachment', 'shomeworks.grade');
						->get();

		$result = ['title'=>'作业列表', 'username'=>session('username'), 'role'=>session('role'), 'result'=>$thomeworks];

		return view('view.student.teacherworks')->with($result);
	}

}

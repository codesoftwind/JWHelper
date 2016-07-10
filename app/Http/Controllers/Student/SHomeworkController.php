<?php namespace App\Http\Controllers\Student;

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
	 * 学生查看自己的作业的详情
	 */
	public function shomework(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$shomeworkID = $request->get('shomeworkID');

		$tmpresult = DB::table('shomeworks')
					->join('thomeworks', 'shomeworks.thomeworkID', '=', 'thomeworks.thomeworkID')
					->select('thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'thomeworks.group', 'thomeworks.description', 'thomeworks.startTime', 'thomeworks.endTime', 'shomeworks.content', 'shomeworks.attachment', 'shomeworks.attachmentName', 'shomeworks.grade', 'shomeworks.comment')
					->where('shomeworks.shomeworkID', $shomeworkID)
					->get();

		$result = ['title'=>'作业', 'username'=>session('username'), 'role'=>session('role'), 'homework'=>$tmpresult];

		return view()->with($result);
 	}

}

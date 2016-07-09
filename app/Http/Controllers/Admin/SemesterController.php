<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SemesterController extends Controller {

	/**
	 * 修改学期信息，学期的数据表中永远只有一条记录
	 */
	public function setSemester(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$semesterID = $request->get('semesterID');
		$semesterYear = (int)$request->get('semesterYear');
		$semesterWeek = (int)$request->get('semesterWeek');
		$basicInfo = $request->get('basicInfo');

		$success = DB::table('semesters')
								->where('id', 1)
								->update(array('semesterID'=>$semesterID, 'semesterYear'=>$semesterYear, 'semesterWeek'=>$semesterWeek, 'basicInfo'=>$basicInfo));
		
		if($success)
			return response()->json(['status'=>1]);
		else
			return response()->json(['status'=>0]);
	}

	/**
	 * 
	 */
	public function semester_info()
	{
		if(!Auth::check())
			return redirect('login');

		$tmpresult = DB::table('semesters')
									->where('id', 1)
									->get();

		$result = ['title'=>'学期信息', 'username'=>session('username'), 'role'=>session('role'), 'semester'=>$tmpresult[0]];

		return view('view.admin.semester_info')->with($result);
	}

}

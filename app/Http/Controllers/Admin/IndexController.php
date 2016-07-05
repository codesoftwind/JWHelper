<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class IndexController extends Controller {

	/**
	 * 显示教务首页
	 */
	public function index()
	{
		if(!Auth::check())
			return redirect('login');

		$adminID = Auth::user()->userID;
		$admin = DB::table('admins')
								->where('adminID', $adminID)
								->select('adminID', 'adminName')
								->get();
		$tmpresult = DB::table('tlessons')
								->join('lessons	', 'tlessons.lessonID', '=', 'lessons.lessonID')
								->join('teachers', 'tlessons.teacherID', '=', 'teachers.teacherID')
								->select('lessons.lessonID', 'lessons.lessonName', 'teachers.teacherID', 'teachers.teacherName')
								->get();
		$result = ['adminID'=>$admin[0]['adminID'], 'adminName'=>$admin[0]['adminName'], 'result'=>$tmpresult];
		return response()->json($result);
	}
	

}

<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class TeacherController extends Controller {

	/**
	 * 教务查看教师列表
	 */
	public function teachersList()
	{
		if(!Auth::check())
			return redirect('login');

		$teachers = DB::table('teachers')
					->select('teacherID', 'teacherName', 'basicInfo')
					->get();

		$result = ['title'=>'教师列表', 'username'=>session('username'), 'role'=>session('role'), 'result'=>$teachers];

		return view('view.admin.teacherlist')->with($result);
	}

}

<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class StudentController extends Controller {

	/**
	 * 教务查看学生列表
	 */
	public function studentsList()
	{
		if(!Auth::check())
			return redirect('login');

		$students = DB::table('students')
						->select('studentID', 'studentName', 'department')
						->get();

		$result = ['title'=>'学生列表', 'username'=>session('username'), 'role'=>session('role'), 'students'=>$students];

		return view('view.admin.studentlist')->with($result);
	}

}

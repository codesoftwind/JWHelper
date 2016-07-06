<?php namespace App\Http\Controllers\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class IndexController extends Controller {

	public function index()
	{
		if(!Auth::check())
			return redirect('login');

		return redirect('student/lessonsList');
	}

}

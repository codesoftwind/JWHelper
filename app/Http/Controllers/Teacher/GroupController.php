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
	 * 教师审核团队申请进入课程
	 */
	public function groupCheck(Request $request)
	{
		
	}

}

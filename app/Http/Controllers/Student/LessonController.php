<?php namespace App\Http\Controllers\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class LessonController extends Controller {

	public function lessonsList()
	{
		if(!Auth::check())
			return redirect('login');
		$datas = DB::select("select * from slessons where studentID = ?",['1']);
		$lessonList = array();
		foreach ($datas as $data) {

		$teacher=DB::select("select teacherName from teachers where teacherID = ?",[$data->teacherID])[0];
		$lessonID=$data->lessonID;
		$year=DB::select("select semesterYear from semesters where semesterID = ?",[$data->semesterID])[0];
		$infor=DB::select("select basicInfo from semesters where semesterID = ?",[$data->semesterID])[0];
		$lessonName=DB::select("select lessonName from lessons where lessonID = ?",[$data->lessonID])[0];
		$result= array('lessonID' => $lessonID,
			'lessonName'=>$lessonName->lessonName,
			'teacherName'=>$teacher->teacherName
		,'semester'=> $year->semesterYear.' '.$infor->basicInfo);
		array_push($lessonList,$result);

			
		}
		return view('view.student.index')->with($lessonList);
	}

}

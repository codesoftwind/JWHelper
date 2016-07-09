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
		$datas = DB::select("select * from slessons where studentID = ?",[session('userID')]);
	    $studentName = DB::select("select studentName from students where studentID = ?",[session('userID')]);

		$lessonList = array();
		foreach ($datas as $data) {
		$teacher=DB::select("select teacherName from teachers where teacherID = ?",[$data->teacherID]);
		$lessonID=$data->lessonID;

		$year=DB::select("select semesterYear from semesters where semesterID = ?",[$data->semesterID]);
		$infor=DB::select("select basicInfo from semesters where semesterID = ?",[$data->semesterID]);
		$lessonName=DB::select("select lessonName from lessons where lessonID = ?",[$data->lessonID]);
		if(count($teacher)==0||count($year)==0||count($infor)==0||count($lessonName)==0)
			break;
		$result= array('lessonID' => $lessonID,
			'lessonName'=>$lessonName[0]->lessonName,
			'teacherName'=>$teacher[0]->teacherName
		,'semester'=> $year[0]->semesterYear.' '.$infor[0]->basicInfo);
		array_push($lessonList,$result);

			
		}

		return view('view.student.index',['lessonList'=>$lessonList,'role'=>'学生','username'=>$studentName[0]->studentName]);
	}

}

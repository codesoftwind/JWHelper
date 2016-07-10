<?php namespace App\Http\Controllers\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class ResourceController extends Controller {

	//
	public function resource(Request $request)
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

		return view('',['lessonList'=>$lessonList,'role'=>'学生','username'=>session('username'));

	}

	public function resourcesList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		$lessonID = $request->lessonID;
		$teacherName=$request->teacherName;
		$teacherID=$request->teacherID;
		$res=DB::select("select * from resources where teacherID =? and lessonID=?",
			           [$teacherID,$lessonID]);
		$resourcesList=array();
		foreach($res as $data)
		{

			$name=DB::select("select catogoryName from rcatogorys where catogoryID=?",[$data->catogoryID]);
			array_push($resourcesList,['teacherName'=>$teacherName,'path'=>$data->resourcePath,'name'=>$data->resourceName,
				                     'catogoryName'=>$name[0]->catogoryName]);
		}
		return view('',['resourcesList'=>$resourcesList,'role'=>session('role'),'username'=>session('username')]);

	}



}

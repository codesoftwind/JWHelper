<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Excel;
use Hash;
use Auth;
class UploadController extends Controller {

	public function uploadTeacher(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		if($request->hasFile('teacher'))
		{
			$file = $request->file('teacher');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			$result=Excel::load($newFilePath)->get();
			foreach ($result as $rows) {
				foreach ($rows as $data) {
					DB::insert("insert into teachers (teacherID,teacherName,password,basicInfo)
                         values(?,?,?,?)",[$data->id,$data->name,Hash::make($data->pass),$data->info]);
				}
			}
			
    		return  view('view.admin.teacherimport');
		}
		else
		{
			return 'error';
		}
	}

	public function uploadStudent(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		if($request->hasFile('student'))
		{
			$file = $request->file('student');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			$result=Excel::load($newFilePath)->get();
			foreach ($result as $rows) {
				foreach ($rows as $data) {					
					DB::insert("insert into students (studentID,studentName,password,department)
                         values(?,?,?,?)",[$data->id,$data->name,Hash::make($data->password),$data->depart]);
				}
			}
			
    		return  view('view.admin.studentimport');
		}
		else
		{
			return 'error';
		}

	}

	public function uploadTeach(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		if($request->hasFile('teach'))
		{
			$file = $request->file('teach');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			$result=Excel::load($newFilePath)->get();
			foreach ($result as $rows) {
				foreach ($rows as $data) {
					DB::insert("insert into tlessons (teacherID,lessonID,semesterID)
                         values(?,?,?)",[$data->teacherid,$data->lessonid,$data->semesterid]);
				}
			}
			
    		return  view('view.admin.teachimport');
		}
		else
		{
			return 'error';
		}

	}

	public function uploadChoose(Request $request)
	{

		if(!Auth::check())
			return redirect('login');
		if($request->hasFile('choose'))
		{
			$file = $request->file('choose');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			$result=Excel::load($newFilePath)->get();
			foreach ($result as $rows) {
				foreach ($rows as $data) {

					DB::insert("insert into slessons (studentID,teacherID,lessonID,semesterID)
           values(?,?,?,?)",[$data->studentid,$data->teacherid,$data->lessonid,$data->semesterid]);
				}
			}
    		return view('view.admin.chooseimport')->with('result', '上传成功');
		}
		else
		{
			return 'error';
		}

	}

	public function uploadLesson(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		if($request->hasFile('lesson'))
		{
			$file = $request->file('lesson');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			$result=Excel::load($newFilePath)->get();
			foreach ($result as $rows) {
				foreach ($rows as $data) {
					DB::insert("insert into lessons (lessonID,lessonName,semesterID)
           values(?,?,?)",[$data->id,$data->name,$data->seme]);
				}
			}
			
    		return  view('view.admin.lessonimport');
		}
		else
		{
			return 'error';
		}

	}

	function uploadTeacherPage()
	{
		if(!Auth::check())
			return redirect('login');
		return view('view.admin.teacherimport');
	}
	function uploadStudentPage()
	{
		if(!Auth::check())
			return redirect('login');
		return view('view.admin.studentimport');
	}
	function uploadTeachPage()
	{
		if(!Auth::check())
			return redirect('login');
		return view('view.admin.teachimport');
	}
	function uploadLessonPage()
	{
		if(!Auth::check())
			return redirect('login');
		return view('view.admin.lessonimport');
	}
	function uploadChoosePage()
	{
		if(!Auth::check())
			return redirect('login');
		return view('view.admin.chooseimport');
	}
	


}

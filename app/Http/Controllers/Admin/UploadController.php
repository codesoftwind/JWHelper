<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UploadController extends Controller {

	public function uploadTeacher(Request $request)
	{
		if($request->hasFile('teacher'))
		{
			$file = $request->file('teacher');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			Excel::load($newFilePath, function($reader) {
        		$dataInfo=$reader->all();

        		foreach ($dataInfo as $data) 
        		{
        			DB::insert("insert into teachers (teacherID,teacherName,password,basicInfo)
                         values(?,?,?,?)",[$data->id,$data->name,$data->password,$data->info]);
        		}
        		
    		});
    		return redirct('admin/index');
		}
		else
		{
			return 'upload error';
		}
	}

	public function uploadStudent()
	{
		if($request->hasFile('student'))
		{
			$file = $request->file('student');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			Excel::load($newFilePath, function($reader) {
        		$dataInfo=$reader->all();

        		foreach ($dataInfo as $data) 
        		{
        			DB::insert("insert into students (studentID,studentName,password,department)
                         values(?,?,?,?)",[$data->id,$data->name,$data->password,$data->depart]);
        		}
        		
    		});
    		return redirct('admin/index');
		}
		else
		{
			return 'upload error';
		}

	}

	public function uploadTeach()
	{
		if($request->hasFile('teach'))
		{
			$file = $request->file('teach');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			Excel::load($newFilePath, function($reader) {
        		$dataInfo=$reader->all();

        		foreach ($dataInfo as $data) 
        		{
        			DB::insert("insert into tleasons (teacherID,lessonID,semesterID)
                         values(?,?,?)",[$data->teacherID,$data->lessonID,$data->semesterID]);
        		}
        		
    		});
    		return redirct('admin/index');
		}
		else
		{
			return 'upload error';
		}

	}

	public function uploadChoose()
	{
		if($request->hasFile('choose'))
		{
			$file = $request->file('choose');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			Excel::load($newFilePath, function($reader) {
        		$dataInfo=$reader->all();

        		foreach ($dataInfo as $data) 
        		{
        			DB::insert("insert into teachers (studentID,teacherID,lessonID,semesterID)
           values(?,?,?,?)",[$data->studentID,$data->teacherID,$data->lessonID,$data->semesterID]);
        		}
        		
    		});
    		return redirct('admin/index');
		}
		else
		{
			return 'upload error';
		}

	}

	public function uploadLesson()
	{
		if($request->hasFile('lesson'))
		{
			$file = $request->file('lesson');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis').$clientName).".".$extension;
			
			$newFilePath=$file->move(app_path().'/storage/excel',$newName);
			Excel::load($newFilePath, function($reader) {
        		$dataInfo=$reader->all();

        		foreach ($dataInfo as $data) 
        		{
        			DB::insert("insert into lessons (lessonID,lessonName,semesterID)
           values(?,?,?)",[$data->id,$data->name,$data->seme]);
        		}
        		
    		});
    		return redirct('admin/index');
		}
		else
		{
			return 'upload error';
		}

	}

	function uploadTeacherPage()
	{
		return view('admin.teacherimport');
	}
	function uploadStudentPage()
	{
		return view('admin.studentimport');
	}
	function uploadTeachPage()
	{
		return view('admin.teachimport');
	}
	function uploadLessonPage()
	{
		return view('admin.lessonimport');
	}
	function uploadChoosePage()
	{
		return view('admin.chooseimport');
	}
	


}

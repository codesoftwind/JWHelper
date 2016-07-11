<?php namespace App\Http\Controllers\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;	

class SHomeworkController extends Controller {

	/**
	 * 学生查看自己的作业的详情
	 */
	public function shomework(Request $request)
	{
		if(!Auth::check())
			return redirect('login');

		$thomeworkID = $request->get('thomeworkID');
		$flag = $request->get('flag');
		
		if(null != ($request->get('shomeworkID')))
		{
			$shomeworkID = $request->get('shomeworkID');

			$tmpresult = DB::table('shomeworks')
					->join('thomeworks', 'shomeworks.thomeworkID', '=', 'thomeworks.thomeworkID')
					->select('thomeworks.teacherID', 'thomeworks.lessonID', 'thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'thomeworks.group', 'thomeworks.description', 'thomeworks.startTime', 'thomeworks.endTime', 'shomeworks.content', 'shomeworks.attachment', 'shomeworks.attachmentName', 'shomeworks.grade', 'shomeworks.comment')
					->where('shomeworks.shomeworkID', $shomeworkID)
					->get();
		}
		elseif(null != ($request->get('thomeworkID')))
		{
			$thomeworkID = $request->get('thomeworkID');

			$tmpresult = DB::table('thomeworks')
					->select('thomeworks.teacherID', 'thomeworks.lessonID', 'thomeworks.thomeworkID', 'thomeworks.thomeworkName', 'thomeworks.group', 'thomeworks.description', 'thomeworks.startTime', 'thomeworks.endTime')
					->where('thomeworks.thomeworkID', $thomeworkID)
					->get();
		}		

		$result = ['title'=>'作业', 'username'=>session('username'), 'role'=>session('role'), 'homework'=>$tmpresult];

		if($flag == 1) //查看详情
			return view('view.student.homeworkdetail')->with($result);
		elseif($flag == 0)
			return  view('view.student.onlinefinishhomework')->with($result);
 	}
 	public function uploadShomework(Request $request)
 	{

 		if(!Auth::check())
 			return redirect('login');
 		$studentID=session('userID');
 		$thomeworkID=$request->thomeworkID;
 		$res=DB::select("select * from thomeworks where thomeworkID=?",[$thomeworkID])[0];
        $semesterID=$res->semesterID;
        $group=$res->group;
        $lessonID=$res->lessonID;
        $teacherID=$res->teacherID;
        $isContent=0;
        $isFile=0;
        if ($request->content!="") {
        	$isContent=1;
        }
        
        if($request->hasFile('choose'))
        	$isFile=1;

        if($group==1)
        { 
        	$groupID=$request->groupID;
            return $groupID;
        	if($isContent==1)
        	{
        		$pan=DB::select("select * from shomeworks where thomeworkID=? and $groupID=?",
        			      [$thomeworkID,$groupID]);
        		if(count($pan)==0)
        		{

        			DB::insert("insert into shomeworks 
        			(thomeworkID,group,groupID,studentID,lessonID,semesterID,content) values(?,?,?,?,?,?,?)",
        			[$thomeworkID,$group,$groupID,$studentID,$lessonID,$semesterID,$request->content]);
        		}
        		else
        		{
        			DB::update("update set content =? where thomeworkID=? and $groupID=?",
        			[$request->content,$thomeworkID,$groupID]);
        		}
        	}
        	if($isFile==1)
        	{
        		$pan=DB::select("select * from shomeworks where thomeworkID=? and $groupID=?",
        			      [$thomeworkID,$groupID]);
        		if(count($pan)==0)
        		{
        			$file = $request->file('choose');
					$clientName=$file->getClientOriginalName();
					$extension=$file->getClientOriginalExtension();
					$string=md5(date('ymdhis'));
					$newName=$string.iconv('UTF-8', 'GBK', $clientName);
                    $filePath="http://localhost/JWHelper/app/storage/homework/".$string.$clientName;
					$newFilePath=$file->move(app_path().'/storage/homework',$newName);
        			DB::insert("insert into shomeworks 
        			(thomeworkID,group,groupID,studentID,lessonID,semesterID,attachment,attachmentName) values(?,?,?,?,?,?,?,?)",
        			[$thomeworkID,$group,$groupID,$studentID,$lessonID,$semesterID,$filePath,$clientName]);
        		}
        		else
        		{
        			$file = $request->file('choose');
					$clientName=$file->getClientOriginalName();
					$extension=$file->getClientOriginalExtension();
					$string=md5(date('ymdhis'));
					$newName=$string.iconv('UTF-8', 'GBK', $clientName);
                    $filePath="http://localhost/JWHelper/app/storage/homework/".$string.$clientName;
					$newFilePath=$file->move(app_path().'/storage/homework',$newName);
        			DB::update("update set attachment =? where thomeworkID=? and $groupID=?",
        			[$filePath,$thomeworkID,$groupID]);
        			DB::update("update set attachmentName =? where thomeworkID=? and $groupID=?",
        			[$clientName,$thomeworkID,$groupID]);
        		}
        	}

        }
        else
        {
        	if($isContent==1)
        	{
        		$pan=DB::select("select * from shomeworks where thomeworkID=? and $studentID=?",
        			      [$thomeworkID,$studentID]);
        		if(count($pan)==0)
        		{
        			DB::insert("insert into shomeworks 
        			(thomeworkID,group,studentID,lessonID,semesterID,content) values(?,?,?,?,?,?,?)",
        			[$thomeworkID,$group,$studentID,$lessonID,$semesterID,$request->content]);
        		}
        		else
        		{
        			DB::update("update set content =? where thomeworkID=? and $studentID=?",
        			[$request->content,$thomeworkID,$studentID]);
        		}
        	}
        	if($isFile==1)
        	{
        		$pan=DB::select("select * from shomeworks where thomeworkID=? and $studentID=?",
        			      [$thomeworkID,$studentID]);
        		if(count($pan)==0)
        		{
        			$file = $request->file('choose');
					$clientName=$file->getClientOriginalName();
					$extension=$file->getClientOriginalExtension();
					$string=md5(date('ymdhis'));
					$newName=$string.iconv('UTF-8', 'GBK', $clientName);
                    $filePath="http://localhost/JWHelper/app/storage/homework/".$string.$clientName;
					$newFilePath=$file->move(app_path().'/storage/homework',$newName);
        			DB::insert("insert into shomeworks 
        			(thomeworkID,group,studentID,lessonID,semesterID,attachment,attachmentName) values(?,?,?,?,?,?,?,?)",
        			[$thomeworkID,$group,$studentID,$lessonID,$semesterID,$filePath,$clientName]);
        		}
        		else
        		{
        			$file = $request->file('choose');
					$clientName=$file->getClientOriginalName();
					$extension=$file->getClientOriginalExtension();
					$string=md5(date('ymdhis'));
					$newName=$string.iconv('UTF-8', 'GBK', $clientName);
                    $filePath="http://localhost/JWHelper/app/storage/homework/".$string.$clientName;
					$newFilePath=$file->move(app_path().'/storage/homework',$newName);
        			DB::update("update set attachment =? where thomeworkID=? and $studentID=?",
        			[$filePath,$thomeworkID,$studentID]);
        			DB::update("update set attachmentName =? where thomeworkID=? and $studentID=?",
        			[$clientName,$thomeworkID,$studentID]);
        		}
        	}

        }
        return "yes";
        return redirect('student/thomeworksList')->with(['teacherID'=>$teacherID,'lessonID'=>$lessonID]);

    }

    
}

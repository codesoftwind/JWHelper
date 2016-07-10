<?php namespace App\Http\Controllers\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class GroupLesson extends Controller {

	//

	public function toApplyLesson(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		$groupID=$request->groupID;
		$groupName=DB::select("select * from groups where groupID =?",[$groupID])[0]->groupName;
		$have=array();
        $choose=DB::select("select * from tsgroups where groupID =?",[$groupID]);
        foreach($choose as $c)
        {
        	array_push($have,$c->lessonID);
        }
		$rest=DB::table('slessons')->where('studentID','=',session('userID'))->whereNotIn('lessonID',$have)->get();
		$toApply=array();
		foreach($rest as $data)
		{
			$teacherID=DB::select("select * from tlessons where lessonID=?",[$data->lessonID])[0]->teacherID;
			$teacherName=DB::select("select * from teachers where teacherID=?",[$teacherID])[0]->teacherName;
			$has=DB::select("select * from tschecks where groupID=?  and lessonID=?",
				             [$groupID,$data->lessonID]);
			$never=DB::select("select * from tschecks where groupID=?  and lessonID=? and status=?",
				             [$groupID,$data->lessonID,0]);
			$refuse=DB::select("select * from tschecks where groupID=?  and lessonID=? and status=?",
				             [$groupID,$data->lessonID,1]);
			 $semester=DB::select("select * from semesters where semesterID =?",[$data->semesterID])[0];
			 $lessons=DB::select("select * from lessons where lessonID =?",[$data->lessonID])[0];
			if(count($has)==0)
				array_push($toApply,['lessonID'=>$data->lessonID,'semester'=>$semester->semesterYear." ".$semester->basicInfo,'teacherName'=>$teacherName,'lessonName'=>$lessons->lessonName
					                 ,'status'=>0]);
			if(count($never)!=0)
				array_push($toApply,['lessonID'=>$data->lessonID,'semester'=>$semester->semesterYear." ".$semester->basicInfo,'teacherName'=>$teacherName,'lessonName'=>$lessons->lessonName
					                 ,'status'=>1]);
			if(count($refuse)!=0)
				array_push($toApply,['lessonID'=>$data->lessonID,'semester'=>$semester->semesterYear." ".$semester->basicInfo,'teacherName'=>$teacherName,'lessonName'=>$lessons->lessonName
					                 ,'status'=>2]);
		}
		return view('view.student.applyLesson',['groupID'=>$groupID,'groupName'=>$groupName,'toApply'=>$toApply,'role'=>session('role'),'username'=>session('username')]);

	}

	public  function groupLesson(Request $request)
	{
		$groupID=$request->groupID;
		$groupName=DB::select("select * from groups where groupID =?",[$groupID])[0]->groupName;
		$res=DB::select("select * from tsgroups where groupID =?",[$groupID]);
		$group=array();
		foreach($res as $data)
		{
			$teacherName=DB::select("select * from teachers where teacherID=?",[$data->teacherID])[0]->teacherName;
            $lesson=DB::select("select * from lessons where lessonID =?",[$data->lessonID])[0];
		    $semester=DB::select("select * from semesters where semesterID =?",[$lesson->semesterID])[0];
		    array_push($group,['teacherName'=>$teacherName,'lessonID'=>$data->lessonID,'semester'=>$semester->semesterYear." ".$semester->basicInfo,'lessonName'=>$lesson->lessonName]);
		}
		return view('view.student.inLesson',['groups'=>$group,'groupID'=>$groupID,'groupName'=>$groupName,'role'=>session('role'),'username'=>session('username')]);
	}

	public function groupApplyLesson(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		$groupID=$request->groupID;
		$groupName=DB::select("select * from groups where groupID =?",[$groupID])[0]->groupName;
		$lessonID=$request->lessonID;
		$teacherID=DB::select("select * from tlessons where lessonID =?",[$lessonID])[0]->teacherID;
        $res=DB::select("select * from tschecks where groupID=? and lessonID=? and teacherID=?",
        	            [$groupID,$lessonID,$teacherID]);
        if(count($res)==0)
        {
        	DB::insert("insert into tschecks (groupID,groupName,teacherID,lessonID,status)
        	            values(?,?,?,?,?)",[$groupID,$groupName,$teacherID,$lessonID,0]);
        }
        else
        	DB::update("update tschecks set status =0 where groupID=? and lessonID=?",
        		        [$groupID,$lessonID]);
        return ['status'=>1];
	}

}

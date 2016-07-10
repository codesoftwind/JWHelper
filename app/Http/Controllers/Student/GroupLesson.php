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
		$have=array();
        $choose=DB::select("select * from tsgroups where groupID =?",[$groupID]);
        foreach($choose as $c)
        {
        	array_push($have,$c->lessonID);
        }
		$rest=DB::table('lesson')->whereNotIn('lessonID',$have);
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
				             [$groupID,$data->lessonID],1);
			 $semester=DB::select("select * from semesters where lessonID =?",[$data->semesterID])[0];
			if(count($has)!=0)
				array_push($toApply,['lessonID'=>$data->lessonID,'semesterName'=>$semester->semesterYear." ".$semester->basicInfo,'teacherName'=>$teacherName,'lessonName'=>$data->lessonName
					                 ,'status'=>0]);
			if(count($never)!=0)
				array_push($toApply,['lessonID'=>$data->lessonID,'semesterName'=>$semester->semesterYear." ".$semester->basicInfo,'teacherName'=>$teacherName,'lessonName'=>$data->lessonName
					                 ,'status'=>1]);
			if(count($refuse)!=0)
				array_push($toApply,['lessonID'=>$data->lessonID,'semesterName'=>$semester->semesterYear." ".$semester->basicInfo,'teacherName'=>$teacherName,'lessonName'=>$data->lessonName
					                 ,'status'=>2]);
		}
		return view('',['toApply'=>$toApply,'role'=>session('role'),'username'=>session('username')]);

	}

	public  function groupLesson(Request $rqeuest)
	{
		$groupID=$request->groupID;
		$res=DB::select("select * from tsgroups where groupID =?",[$groupID]);
		$group=array();
		foreach($res as $data)
		{
			$teacherName=DB::select("select * from teachers where teacherID=?",[$data->teacherID])[0]->teacherName;
            $lesson=DB::select("select * from lessons where lessonID =?",[$data->lessonID])[0];
		    $semester=DB::select("select * from semesters where lessonID =?",[$lesson->semesterID])[0];
		    array_push($group,['teacerName'=>$teacherName,'lessonName'=>$lesson->lessonName]);
		}
		return view('',['groups'=>$group,'lessonID'=>$data->lessonID,'semesterName'=>$semester->semesterYear." ".$semester->basicInfo,'role'=>session('role'),'username'=>session('username')]);
	}

}

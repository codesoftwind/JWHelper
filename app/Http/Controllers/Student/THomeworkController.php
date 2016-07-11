<?php namespace App\Http\Controllers\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class THomeworkController extends Controller {

	/**
	 * 学生查看某一门课的作业列表
	 */
	public function thomeworksList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
        
		$teacherID = $request->teacherID;
		$lessonID = $request->get('lessonID');
		
		$studentID = session('userID');
        $have=DB::select("select * from sgroups where studentID =?",[$studentID]);
        $haveJoin=array();
        foreach($have as $ha)
        {
        	array_push($haveJoin, $ha->groupID);
        }
        
        $groupApply=DB::table('tsgroups')
                    ->whereIn('groupID',$haveJoin)
                    ->where('teacherID','=',$teacherID)
                    ->where('lessonID','=',$lessonID)
                    ->get();
        $groupID=-1;
        if(count($groupApply)!=0)
        {
        	$groupID=$groupApply[0]->groupID;
        } 
        $groupHomework=array();
        $sgroupHomework=array();
       
        if($groupID!=-1)
        {
        	$groupHomework=DB::table('thomeworks')
						->select('thomeworkID', 'thomeworkName', 'startTime', 'endTime', 'group')
						->where('teacherID', $teacherID)
						->where('lessonID', $lessonID)
						->where('group','=',1)
						
						->get();
			foreach ($groupHomework as $gr) {
				    $temp= DB::table('shomeworks')
			               ->select('shomeworks.shomeworkID','thomeworkID', 'shomeworks.grade', 'shomeworks.content', 'shomeworks.attachment')
			               ->where('thomeworkID','=',$gr->thomeworkID)
			               ->where('groupID','=',$groupID)
			               ->get();
				     array_push($sgroupHomework, $temp);
			}
        }           
		
		$singleHomework=DB::table('thomeworks')
						->select('thomeworkID', 'thomeworkName', 'startTime', 'endTime', 'group')
						->where('teacherID', $teacherID)
						->where('lessonID', $lessonID)
						->where('group','=',0)
						->get();
        $ssingleHomework=array();
        foreach($singleHomework as $si)
        {
        	$temp2= DB::table('shomeworks')
			               ->select('shomeworks.shomeworkID', 'thomeworkID','shomeworks.grade', 'shomeworks.content', 'shomeworks.attachment')
			               ->where('thomeworkID','=',$si->thomeworkID)
			               ->where('studentID','=',session('userID'))
			               ->get();
			 array_push($ssingleHomework, $temp2);
        }
		/*$thomeworks = DB::table('thomeworks')
						->select('thomeworkID', 'thomeworkName', 'startTime', 'endTime', 'group')
						->where('teacherID', $teacherID)
						->where('lessonID', $lessonID)
						->get();*/

		/*$shomeworks = array();

		foreach ($thomeworks as $thomework) 
		{
			$group = $thomework->group;

			//判断是否是团队作业
			if($group)
			{
				$tmp = DB::table('shomeworks')
						->join('groups', 'shomeworks.groupID', '=', 'groups.groupID')
						->join('sgroups', 'sgroups.groupID', '=', 'groups.groupID')
						->select('shomeworks.shomeworkID', 'shomeworks.grade', 'shomeworks.content', 'shomeworks.attachment')
						->where('shomeworks.thomeworkID', $thomework->thomeworkID)
						->where('sgroups.studentID', $studentID)
						->get();

				array_push($shomeworks, $tmp);
			}
			else
			{
				$tmp = DB::table('shomeworks')
						->join('students', 'shomeworks.studentID', '=', 'students.studentID')
						->select('shomeworks.shomeworkID', 'shomeworks.grade', 'shomeworks.content', 'shomeworks.attachment')
						->where('shomeworks.thomeworkID', $thomework->thomeworkID)
						->where('shomeworks.studentID', $studentID)
						->get();

				array_push($shomeworks, $tmp);
			}
		}*/


      
		$result = ['title'=>'作业列表', 'username'=>session('username'), 'role'=>session('role')
		,'groupID'=>$groupID
		, 'groupHomework'=>$groupHomework,'sgroupHomework'=>$sgroupHomework,
		 'singleHomework'=>$singleHomework,'ssingleHomework'=>$ssingleHomework];
      
		return view('view.student.teacherworks')->with($result);
	}



	/**
	 * 学生点击作业列表之后显示课程列表
	 */
	public function thlessonsList()
	{
		if(!Auth::check())
			return redirect('login');

		$studentID = session('userID');

		$lessons = DB::table('slessons')
						->join('lessons', 'lessons.lessonID', '=', 'slessons.lessonID')
						->join('teachers', 'teachers.teacherID', '=', 'slessons.teacherID')
						->select('lessons.lessonID', 'lessons.lessonName', 'teachers.teacherID', 'teachers.teacherName')
						->where('slessons.studentID', $studentID)
						->get();

		$result = ['title'=>'所有课程', 'username'=>session('username'), 'role'=>session('role'), 'lessons'=>$lessons];

		return view('view.student.lessonHomework')->with($result);
	}

}

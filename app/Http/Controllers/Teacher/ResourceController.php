<?php namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class ResourceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 */
	public function resourcesList(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		$teacher=session('userID');
		$lesson=session('lessonID');
		$list=array();
		$catogory=DB::select("select * from rcatogorys where teacherID =? and 
			lessonID = ?",[$teacher,session('lessonID')]);
		
		foreach ($catogory as $data) {
			
			$id=$data->catogoryID;
			$res=DB::select("select * from resources where teacherID =? and 
			lessonID =? and catogoryID=?",[$teacher,$lesson,$id]);
			$files=array();
			foreach($res as $f)
			{
				$file=['name'=>$f->resourceName,'url'=>$f->resourcePath,'info'=>$f->resourceInfo];
				array_push(files, $file);
			}
			array_push($list,['category'=>$data->catogoryName,'items'=>$files]);
		}
		return view('view.teacher.resourcesList',['data'=>$list,'categories'=>$catogory,'title'=>"资源列表",
			    'username'=>session('username'),'role'=>session('role')]);

	}

	public function resourcesClassify(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		DB::insert("insert into rcatogorys (catogoryName,teacherID,lessonID) 
			values(?,?,?)",[$request->catogoryName,session('userID'),$request->lessonID]);
		return view('');
	}

	public function resourceUpload(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		if($request->hasFile('resource'))
		{
			$file = $request->file('resource');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=md5(date('ymdhis')).$clientName.".".$extension;
			$newFilePath=$file->move(app_path().'/storage/resource',$newName);
			DB::insert("insert into resources (teacherID,lessonID,catogoryID,
				resourceName,resourcePath) values(?,?,?,?,?)",
			[session('userID'),$request->lessonID,$request->catogoryID,
			$clientName,$newFilePath]);
			return  view('',['success'=>'1',
    			'username'=>session('username'),'role'=>session('role'),
    			'lessonID'=>$request->lessonID]);
		}
	}

	public function resourceDownload()
	{

	}
	

}

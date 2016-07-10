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
		$catogory=DB::select("select catogoryID ,catogoryName from rcatogorys where teacherID =? and 
			lessonID = ?",[$teacher,session('lessonID')]);
		
		foreach ($catogory as $data) {
			
			$id=$data->catogoryID;
			$res=DB::select("select * from resources where teacherID =? and 
			lessonID =? and catogoryID=?",[$teacher,$lesson,$id]);
			$files=array();
			foreach($res as $f)
			{
				$file=['name'=>$f->resourceName,'url'=>$f->resourcePath,'info'=>$f->resourceInfo];
				array_push($files, $file);
			}
			array_push($list,['category'=>$data->catogoryName,'items'=>$files]);
		}
		//return $list;
		//return view('view.teacher.resourcesList',['data'=>[],'categories'=>[]]);
		//return $catogory;
		return view('view.teacher.resourcesList',['data'=>$list,'categories'=>$catogory,
			    'username'=>session('username'),'role'=>session('role')]);

	}

	public function resourcesClassify(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
		DB::insert("insert into rcatogorys (catogoryName,teacherID,lessonID) 
			values(?,?,?)",[$request->categoryName,session('userID'),session('lessonID')]);
		return json_encode(['status'=>1]);
	}

	public function resourceUpload(Request $request)
	{
		if(!Auth::check())
			return redirect('login');
     
		if(isset($request->resourceName))
			return json_encode(['status'=>1]);
		else
			return json_encode(['status'=>0]);
		if($request->hasFile('resourceFile'))
		{
				return  json_encode(['status'=>1]);
			$file = $request->file('resourceFile');
			$clientName=$file->getClientOriginalName();
			$extension=$file->getClientOriginalExtension();
			$newName=iconv('UTF-8', 'GBK', $clientName.md5(date('ymdhis')).".".$extension);
			$newFilePath=$file->move(app_path().'/storage/resource',$newName);
			DB::insert("insert into resources (teacherID,lessonID,catogoryID,
				resourceName,resourcePath) values(?,?,?,?,?)",
			[session('userID'),session('lessonID'),$request->resourceCategory,
			$clientName,$newFilePath]);
			return  json_encode(['status'=>1]);
	     }
	     else
	     	return json_encode(['status'=>0]);
	 }

	public function resourceDownload()
	{

	}
	

}

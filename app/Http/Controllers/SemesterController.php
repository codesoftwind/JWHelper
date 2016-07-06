<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Semester;
use Request;

class SemesterController extends Controller {
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function semester()
	{
		//
		$semester=Semester::find(1);
		return view('view.admin.semester_info',compact('semester'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//
		$semester=Semester::find(1);
		$request = Request::all();
		$semester['semesterID']=$request['semesterID'];
		$semester['semesterYear']=$request['semesterYear'];
		$semester['semesterWeek']=$request['semesterWeek'];
		$semester['basicInfo']=$request['basicInfo'];
		$semester->save();
		
		$semester2=Semester::find(1);
		if($semester2['semesterID']==$semester['semesterID'])
			$status='[{"status":"1"}]';
		else 
			$status='[{"status":"0"}]';
		
		return view('view.admin.semester_info',compact('semester','status'));
	}
}
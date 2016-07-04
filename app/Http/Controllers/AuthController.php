<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller {

	//返回index页面，即登录页面
	public function index()
	{
		return view('view.index');
	}

	//登录的身份认证
	public function login()
	{
		//在users表中进行身份认证，然后再根据users表中的字段确定登录的用户的身份
		if(Auth::attempt(['userID' => $userID, 'password' => $password]))
		{
			if(Auth::user()->isAdmin)
			{
				
			}
			elseif(Auth::user()->isTeacher)
			{

			}
			elseif(Auth::user()->isStudent)
			{
				
			}
		}
		else
		{

		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

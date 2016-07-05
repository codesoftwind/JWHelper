<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
//laravel预定义的两个进行用户认证的controller
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//登录页面路由
Route::get('index', 'AuthController@index');
Route::get('firstpage', 'AuthController@firstpage');

//负责用户登录的路由
Route::post('login', 'AuthController@login');

Route::get('index', 'AuthController@check');

//教务路由
//Route::get('admin/index', 'AdminController@index');
Route::get('admin/index', function(){
	return view('view.admin.index',['title'=>'admin','role'=>'admin','username'=>'admin']);
});

//教师路由
Route::get('teacher/index', 'TeacherController@index');
Route::get('teacher/lessonslist', 'TeacherController@lessonslist');
Route::get('teacher/lesson', 'TeacherController@lesson');
Route::get('teacher/resourceslist', 'TeacherController@resourceslist');
Route::get('teacher/resourcesclassify', 'TeacherController@resourcesclassify');
Route::get('teacher/resourceupload', 'TeacherController@resourceupload');
Route::get('teacher/resourcedownload', 'TeacherController@resourcedownload');
Route::get('teacher/homeworkslist', 'TeacherController@homeworkslist');
Route::get('teacher/homeworkpublish', 'TeacherController@homeworkpublish');
Route::get('teacher/homework', 'TeacherController@homework');
Route::get('teacher/stuhomework', 'TeacherController@stuhomework');
Route::get('teacher/stuhomeworkdownload', 'TeacherController@stuhomeworkdownload');
Route::get('teacher/stuhomeworkrate', 'TeacherController@stuhomeworkrate');
Route::get('teacher/groupverify', 'TeacherController@groupverify');



//学生路由
Route::get('student/index', 'StudentController@index');
Route::get('student/lessons', 'StudentController@lessonlist');
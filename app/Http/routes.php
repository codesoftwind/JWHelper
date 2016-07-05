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
Route::get('login', 'AuthController@login');

//认证用户登录的路由
Route::post('authLogin', 'AuthController@authLogin');

//教务路由
Route::get('admin/index', 'Admin/IndexController@index');
Route::get('admin/uploadTeacher','Admin/UploadController@uploadTeacher');
Route::get('admin/uploadStudent','Admin/UploadController@uploadStudent');
Route::get('admin/uploadTeach','Admin/UploadController@uploadTeach');
Route::get('admin/uploadChoose','Admin/UploadController@uploadChoose');



//教师路由
Route::get('teacher/index', 'Teacher/IndexController@index');
Route::get('teacher/lessonsList', 'Teacher/LessonController@lessonsList');
Route::get('teacher/lesson', 'Teacher/LessonController@lesson');
Route::get('teacher/resourcesList', 'Teacher/ResourceController@resourcesList');
Route::get('teacher/resourcesClassify', 'Teacher/ResourceController@resourcesClassify');
Route::get('teacher/resourceUpload', 'Teacher/ResourceController@resourceUpload');
Route::get('teacher/resourceDownload', 'Teacher/ResourceController@resourceDownload');
Route::get('teacher/homeworksList', 'Teacher/HomeworkController@homeworksList');
Route::get('teacher/homeworkPublish', 'Teacher/HomeworkController@homeworkPublish');
Route::get('teacher/homework', 'Teacher/HomeworkController@homework');
Route::get('teacher/stuHomework', 'Teacher/StuHomeworkController@stuHomework');
Route::get('teacher/stuHomeworkDownload', 'Teacher/StuHomweorkController@stuHomeworkDownload');
Route::get('teacher/stuHomeworkRate', 'Teacher/StuHomeworkController@stuHomeworkRate');


//学生路由
Route::get('student/index', 'StudentController@index');
Route::get('student/lessonsList', 'StudentController@lessonsList');
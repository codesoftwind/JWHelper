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

//注销用户登录的路由
Route::get('logout', 'AuthController@logout');

//未开发页面的路由
Route::get('template/no-page', 'AuthController@nopage');

//统一的index路由
Route::get('index', 'IndexController@index');

//教务路由
Route::get('admin/index', 'Admin\IndexController@index');
Route::post('admin/uploadTeacher','Admin\UploadController@uploadTeacher');
Route::post('admin/uploadStudent','Admin\UploadController@uploadStudent');
Route::post('admin/uploadTeach','Admin\UploadController@uploadTeach');
Route::post('admin/uploadChoose','Admin\UploadController@uploadChoose');
Route::post('admin/uploadLesson', 'Admin\UploadController@uploadLesson');
Route::get('admin/uploadTeacherPage', 'Admin\UploadController@uploadTeacherPage');
Route::get('admin/uploadStudentPage', 'Admin\UploadController@uploadStudentPage');
Route::get('admin/uploadTeachPage', 'Admin\UploadController@uploadTeachPage');
Route::get('admin/uploadChoosePage', 'Admin\UploadController@uploadChoosePage');
Route::get('admin/uploadLessonPage', 'Admin\UploadController@uploadLessonPage');
Route::post('admin/setSemester', 'Admin\SemesterController@setSemester');
Route::get('admin/semester_info', 'Admin\SemesterController@semester_info');



//教师路由
Route::get('teacher/index', 'Teacher\IndexController@index');
Route::get('teacher/lessonsList', 'Teacher\LessonController@lessonsList');
Route::get('teacher/lesson', 'Teacher\LessonController@lesson');
Route::post('teacher/resourcesList', 'Teacher\ResourceController@resourcesList');
Route::get('teacher/resourcesClassify', 'Teacher\ResourceController@resourcesClassify');
Route::get('teacher/resourceUpload', 'Teacher\ResourceController@resourceUpload');
Route::get('teacher/resourceDownload', 'Teacher\ResourceController@resourceDownload');
Route::post('teacher/homeworksList', 'Teacher\HomeworkController@homeworksList');
Route::post('teacher/homeworkPublish', 'Teacher\HomeworkController@homeworkPublish');
Route::get('teacher/homework', 'Teacher\HomeworkController@homework');
Route::get('teacher/stuHomework', 'Teacher\StuHomeworkController@stuHomework');
Route::get('teacher/stuHomeworkDownload', 'Teacher\StuHomweorkController@stuHomeworkDownload');
Route::get('teacher/stuHomeworkRate', 'Teacher\StuHomeworkController@stuHomeworkRate');


//学生路由
Route::get('student/index', 'Student\IndexController@index');
Route::get('student/lessonsList', 'Student\LessonController@lessonsList');
Route::get('student/groupsList', 'Student\GroupController@groupsList');
Route::post('student/groupForm', 'Student\GroupController@groupForm');


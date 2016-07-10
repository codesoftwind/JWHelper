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
Route::post('teacher/lesson', 'Teacher\LessonController@lesson');
Route::get('teacher/resourcesList', 'Teacher\ResourceController@resourcesList');
Route::post('teacher/resourcesClassify', 'Teacher\ResourceController@resourcesClassify');
Route::post('teacher/resourceUpload', 'Teacher\ResourceController@resourceUpload');
Route::get('teacher/resourceDownload', 'Teacher\ResourceController@resourceDownload');
Route::get('teacher/thomeworksList', 'Teacher\THomeworkController@thomeworksList');
Route::post('teacher/thomeworkPublish', 'Teacher\THomeworkController@thomeworkPublish');
Route::post('teacher/thomework', 'Teacher\THomeworkController@thomework');
Route::post('teacher/shomework', 'Teacher\SHomeworkController@shomework');
Route::get('teacher/shomeworkDownload', 'Teacher\SHomweorkController@shomeworkDownload');
Route::post('teacher/shomeworkRate', 'Teacher\SHomeworkController@shomeworkRate');
Route::post('teacher/groupCheck', 'Teacher\GroupController@groupCheck');
Route::get('teacher/groupsInList', 'Teacher\GroupController@groupsInList');
Route::get('teacher/groupsIOList', 'Teacher\GroupController@groupsIOList');
Route::get('teacher/groupsOutList', 'Teacher\GroupController@groupsOutList');
Route::post('teacher/group', 'Teacher\GroupController@group');



//学生路由
Route::get('student/index', 'Student\IndexController@index');
Route::get('student/lessonsList', 'Student\LessonController@lessonsList');
Route::get('student/myGroups', 'Student\GroupController@myGroups');
Route::get('student/groupList', 'Student\GroupController@groupsList');
Route::get('student/toApply', 'Student\GroupController@toApply');
Route::get('student/checkList', 'Student\GroupController@checkList');
Route::get('student/homeworkInfo',function ()
	{ return view('view.student.onlinefinishhomework');});

Route::post('student/apply', 'Student\GroupController@apply');
Route::post('student/check', 'Student\GroupController@check');
Route::post('student/groupForm', 'Student\GroupController@groupForm');


Route::post('student/uploadShomework','Student\SHomeworkController@uploadShomework');
Route::post('student/shomework', 'Student\SHomeworkController@shomework');
Route::post('student/thomeworksList', 'Student\THomeworkController@thomeworksList');

Route::get('student/applyLesson', function () {
		return view('view.student.applyLesson');
});

Route::get('student/lessonResource', function () {
		return view('view.student.lessonResource');
});

Route::get('student/lessonResourceList', function () {
	return view('view.student.lessonResourceList');
});

Route::get('student/lessonList', function () {
	return view('view.student.inLesson');
});
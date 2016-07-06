@extends('view.template.layout')

@section('sidebar')
    <ul class="nav nav-sidebar">
      <li id="index"><a href="http://localhost/JWHelper/public/admin/semester_info">课程列表 <span class="sr-only">(current)</span></a></li>
      <li id="importCourse"><a href="http://localhost/JWHelper/public/admin/uploadLessonPage">导入课程</a></li>
      <li id="importSelect"><a href="http://localhost/JWHelper/public/admin/uploadChoosePage">导入选课表</a></li>
      <li id="importTeach"><a href="http://localhost/JWHelper/public/admin/uploadTeachPage">导入授课表</a></li>
      <li id="tag"><a href="http://localhost/JWHelper/public/admin/semester_info">学期信息设置</a></li>
    </ul>
    <ul class="nav nav-sidebar">
      <li id="tag"><a href="http://localhost/JWHelper/public/template/no-page">教师列表</a></li>
      <li id="tag"><a href="http://localhost/JWHelper/public/template/no-page">学生列表</a></li>
      <li id="tag"><a href="http://localhost/JWHelper/public/admin/uploadTeacherPage">导入教师信息</a></li>
      <li id="tag"><a href="http://localhost/JWHelper/public/admin/uploadStudentPage">导入学生信息</a></li>
    </ul>
@endsection
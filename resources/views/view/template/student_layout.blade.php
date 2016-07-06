@extends('view.template.layout')

@section('sidebar')
	@parent
      <ul class="nav nav-sidebar">
        <li class="active"><a href="http://localhost/JWHelper/public/student/lessonList">课程列表 <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="http://localhost/JWHelper/public/template/no-page">课程资源</a></li>
        <li><a href="http://localhost/JWHelper/public/student/teamsList">学生团队</a></li>        
        <li><a href="http://localhost/JWHelper/public/template/no-page">作业</a></li>
        <li><a href="http://localhost/JWHelper/public/template/no-page">在线交流</a></li>
      </ul>
@endsection
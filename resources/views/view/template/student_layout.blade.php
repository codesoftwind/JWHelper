@extends('view.template.layout')

@section('sidebar')
	@parent
      <ul class="nav nav-sidebar">
          <li class="active" id="lessonList"><a href="#">课程列表</a></li>
      </ul>
      <ul class="nav nav-sidebar">
        <li id="resource"><a href="#">课程资源</a></li>
        <li id="team"><a href="#">学生团队</a></li>
        <li id="homework"><a href="#">作业</a></li>
        <li id="communication"><a href="#">在线交流</a></li>
      </ul>
@endsection
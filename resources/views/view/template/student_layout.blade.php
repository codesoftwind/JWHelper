@extends('view.template.layout')

@section('sidebar')
	@parent
      <ul class="nav nav-sidebar">
        <li class="active" id="list"><a href="#">课程列表</a></li>
      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="" id="resource">课程资源</a></li>
        <li><a href="" id="studentTeam">学生团队</a></li>
        <li><a href="" id="homework">作业</a></li>
        <li><a href="" id="communication">在线交流</a></li>
      </ul>
@endsection
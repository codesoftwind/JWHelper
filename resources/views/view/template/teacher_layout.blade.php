@extends('view.template.layout')

@section('sidebar')
	@parent
    <ul class="nav nav-sidebar">
      <li class="active" id="index"><a href="http://localhost/JWHelper/public/teacher/index"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 课程列表</a></li>
    </ul>
    <ul class="nav nav-sidebar">
      <li id="resource"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 资源列表</a></li>
      <li id="tag"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 资源分类标签</a></li>
      <li id="homework"><a href="http://localhost/JWHelper/public/teacher/homework"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> 作业列表</a></li>
      <li id="team"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 团队列表</a></li>
      <li id="chat"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 在线交流</a></li>
    </ul>
@endsection
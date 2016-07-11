@extends('view.template.layout')

<?php
    $baseURL = 'http://localhost/JWHelper/public/teacher';
?>

@section('sidebar')
	@parent
    <ul class="nav nav-sidebar">
      <li id="index"><a href="http://localhost/JWHelper/public/teacher/index"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 课程列表</a></li>
    </ul>
    @if(Session::has('lessonID'))
      <ul class="nav nav-sidebar">
        <li id="resource"><a href="http://localhost/JWHelper/public/teacher/resourcesList"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 资源列表</a></li>
        <li id="homework"><a href="http://localhost/JWHelper/public/teacher/thomeworksList"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> 作业列表</a></li>
        <li id="group"><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 学生团队</a></li>
        <li id="groupsInList" class="displayNone"><a href="{{$baseURL. '/groupsInList'}}">已加入的团队</a><li>
        <li id="groupsIOList" class="displayNone"><a href="{{$baseURL. '/groupsIOList'}}">待审核的团队</a><li>
        <li id="groupsOutList" class="displayNone"><a href="{{$baseURL. '/groupsOutList'}}">审核被拒团队</a><li>
        <li id="chat"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 在线交流</a></li>
      </ul>
    @endif
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            $("#group").click(function () {
                $("#group").addClass('active');
                $("#groupsInList").toggleClass("displayNone");
                $("#groupsIOList").toggleClass("displayNone");
                $("#groupsOutList").toggleClass("displayNone");
            });
        });
    </script>
@endsection
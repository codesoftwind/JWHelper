@extends('view.template.layout')

<?php
    $baseURL = 'http://localhost/JWHelper/public/student';
?>

@section('sidebar')
	@parent
      <ul class="nav nav-sidebar">
          <li class="active" id="lessonList"><a href="{{$baseURL.'/lessonsList'}}">课程列表</a></li>
      </ul>
      <ul class="nav nav-sidebar">
          <li id="resource"><a href="#">课程资源</a></li>
          <li id="team"><a href="#">学生团队</a></li>
          <li id="myTeam" class="displayNone"><a href="{{$baseURL. '/myGroup'}}">我的团队</a><li>
          <li id="inTeam" class="displayNone"><a href="{{$baseURL. '/inGroup'}}">已加入的团队</a><li>
          <li id="outTeam" class="displayNone"><a href="{{$baseURL. '/outGroup'}}">可加入的团队</a><li>
          <li id="homework"><a href="#">作业</a></li>
          <li id="communication"><a href="#">在线交流</a></li>
      </ul>
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            $("#team").click(function () {
                $("#myTeam").toggleClass("displayNone");
                $("#inTeam").toggleClass("displayNone");
                $("#outTeam").toggleClass("displayNone");
            });
        });
    </script>
@endsection
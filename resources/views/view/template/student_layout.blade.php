@extends('view.template.layout')

<?php
    $baseURL = 'http://localhost/JWHelper/public/student';
?>

@section('sidebar')
	@parent
      <ul class="nav nav-sidebar">
          <li id="lessonList"><a href="{{$baseURL.'/lessonsList'}}"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> 课程列表</a></li>
      </ul>
      <ul class="nav nav-sidebar">
          <li id="resource"><a href="{{$baseURL.'/lessonResource'}}"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> 课程资源</a></li>
          <li id="group"><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 学生团队</a></li>
          <li id="myGroup" class="displayNone"><a href="{{$baseURL. '/myGroups'}}">我的团队</a><li>
          <li id="inGroup" class="displayNone"><a href="{{$baseURL. '/groupList'}}">已加入的团队</a><li>
          <li id="outGroup" class="displayNone"><a href="{{$baseURL. '/toApply'}}">可加入的团队</a><li>
          <li id="homework"><a href="{{$baseURL.'/homeworkInfo'}}"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 作业</a></li>
          <li id="communication"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 在线交流</a></li>
      </ul>
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            $("#group").click(function () {
                $(".nav-sidebar>li").removeClass("active");
                $(this).addClass("active");
                $("#myGroup").toggleClass("displayNone");
                $("#inGroup").toggleClass("displayNone");
                $("#outGroup").toggleClass("displayNone");
            });
        });
    </script>
@endsection
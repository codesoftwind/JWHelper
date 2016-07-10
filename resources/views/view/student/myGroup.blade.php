@extends('view.student.group_layout')

@section('header', '我的团队')

@section('main_content')
    <table class="table">
        <thead>
        <tr>
            <th style="color:#55595c;background-color:#eceeef">团队名称</th>
            <th style="color:#55595c;background-color:#eceeef">团队负责人</th>
            <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
            <th style="color:#55595c;background-color:#eceeef">团队现有人数</th>
            <th style="color:#55595c;background-color:#eceeef">审核(申请人数)</th>
            <th style="color:#55595c;background-color:#eceeef"></th>
            <th style="color:#55595c;background-color:#eceeef"></th>
            <th style="color:#55595c;background-color:#eceeef"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($myGroups as $group)
            <tr>
                <th>{{$group['group']->groupName}}</th>
                <th>{{$group['group']->headName}}</th>
                <th>{{$group['group']->maxPeople}}</th>
                <th>{{$group['group']->occupied}}</th>
                <th><button class="btn btn-primary check" data-group-id="{{$group['group']->groupID}}">审核<span> ( {{$group['applyCount']}} ) </span></button></th>
                <th><button class="btn btn-success apply-lesson" data-group-id="{{$group['group']->groupID}}">申请课程</button></th>
                <th><button class="btn btn-primary lesson-list" data-group-id="{{$group['group']->groupID}}">已选课程</button></th>
                <th><button class="btn btn-danger exit">退出团队</button></th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            var baseURL = "http://localhost/JWHelper/public/student";
            // 更改sidebar的样式, 使当前页面显示为active
            $("#myGroup").addClass("active");

            $(".check").click(function () {
                var groupID = $(this).data('groupId');
                window.location.href = baseURL + '/checkList?groupID=' + groupID;
            });

            $(".apply-lesson").click(function () {
                var groupID = $(this).data('groupId');
                window.location.href = baseURL + '/applyLesson?groupID=' + groupID;
            });

            $(".lesson-list").click(function () {
                var groupID = $(this).data('groupId');
                window.location.href = baseURL + '/lessonList?groupID=' + groupID;
            });

            //To do 退出团队
            $(".exit").click(function () {

            });
        });
    </script>
@endsection
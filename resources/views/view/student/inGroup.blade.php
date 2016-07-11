@extends('view.student.group_layout')

@section('header', '已加入的团队')

@section('main_content')
    <table class="table">
        <thead>
        <tr>
            <th style="color:#55595c;background-color:#eceeef">团队名称</th>
            <th style="color:#55595c;background-color:#eceeef">团队负责人</th>
            <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
            <th style="color:#55595c;background-color:#eceeef">团队现有人数</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ingroups as $group)
            <tr>
                <th>{{$group->groupName}}</th>
                <th>{{$group->headName}}</th>
                <th>{{$group->maxPeople}}</th>
                <th>{{$group->occupied}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


@section('bodyJS')
    @parent
    <script>
        // 更改sidebar的样式, 使当前页面显示为active
        $("#inGroup").addClass("active");

        $(function () {
            // To do
            $(".exit").click(function () {

            });
        });
    </script>
@endsection
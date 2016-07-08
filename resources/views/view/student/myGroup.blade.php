@extends('view.student.group_layout')

@section('header', '我的团队')

@section('main_content')
    <?php
        $ingroups = [
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2'],
        ];
    ?>
    <table class="table">
        <thead>
        <tr>
            <th style="color:#55595c;background-color:#eceeef">团队名称</th>
            <th style="color:#55595c;background-color:#eceeef">团队负责人</th>
            <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
            <th style="color:#55595c;background-color:#eceeef">团队现有人数</th>
            <th style="color:#55595c;background-color:#eceeef">审核(申请人数)</th>
            <th style="color:#55595c;background-color:#eceeef">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ingroups as $group)
            <tr>
                <th>{{$group->groupName}}</th>
                <th>{{$group->headName}}</th>
                <th>{{$group->maxPeople}}</th>
                <th>{{$group->occupied}}</th>
                <th><button class="btn btn-primary check">审核<span> ( {{$group->applyPeople}} ) </span></button></th>
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
            $(".check").click(function () {
                window.location.href = "http://localhost/JWHelper/public/student/checkGroup";
            });

            //To do 退出团队
            $(".exit").click(function () {

            });
        });
    </script>
@endsection
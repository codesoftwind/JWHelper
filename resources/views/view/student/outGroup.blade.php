@extends('view.student.group_layout')

@section('header', '可加入的团队')

@section('main_content')
    <?php
        $ingroups = [
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2', 'applyFlag' => '1'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2', 'applyFlag' => '1'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2', 'applyFlag' => '0'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2', 'applyFlag' => '0'],
                (object)['groupName' => 'Exciting', 'headName' => 'Leo', 'maxPeople' => '5', 'occupied' => '4', 'applyPeople' => '2', 'applyFlag' => '1'],
        ];
    ?>
    <table class="table">
        <thead>
        <tr>
            <th style="color:#55595c;background-color:#eceeef">团队名称</th>
            <th style="color:#55595c;background-color:#eceeef">团队负责人</th>
            <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
            <th style="color:#55595c;background-color:#eceeef">团队现有人数</th>
            <th style="color:#55595c;background-color:#eceeef">申请状态</th>
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
                <th>
                    @if ($group->applyFlag)
                        {{'已申请'}}
                    @endif
                </th>
                <th><button class="btn btn-primary apply">申请加入</button></th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('bodyJS')
    @parent
    <script>
        // 更改sidebar的样式, 使当前页面显示为active
        $(".nav-sidebar>li").removeClass("active");
        $("#outGroup").addClass("active");

        $(function () {
            // To do
            $(".apply").click(function () {

            });
        });
    </script>
@endsection
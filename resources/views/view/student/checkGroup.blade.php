@extends('view.student.group_layout')

@section('header', '审核团队')

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
            <th style="color:#55595c;background-color:#eceeef">申请人姓名</th>
            <th style="color:#55595c;background-color:#eceeef">团队名称</th>
            <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
            <th style="color:#55595c;background-color:#eceeef">团队现有人数</th>
            <th style="color:#55595c;background-color:#eceeef"></th>
            <th style="color:#55595c;background-color:#eceeef"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($ingroups as $group)
            <tr>
                <th>{{$group->headName}}</th>
                <th>{{$group->groupName}}</th>
                <th>{{$group->maxPeople}}</th>
                <th>{{$group->occupied}}</th>
                <th><button class="btn btn-success">同意</button></th>
                <th><button class="btn btn-danger">拒绝</button></th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@extends('view.template.student_layout')

@section('main_panel')
    @parent
    <?php
            $groupID = '1';
            $groupName = '一颗赛艇';
            $lessonList = [
                ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'time' => '2016-07-10 10:00:00'],
                ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'time' => '2016-07-10 10:00:00'],
                ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'time' => '2016-07-10 10:00:00'],
                ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'time' => '2016-07-10 10:00:00'],
                ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'time' => '2016-07-10 10:00:00'],
            ];
    ?>
    <h1 class="page-header">已选课程</h1>
    <h2 class="sub-header"><small>团队名称: {{$groupName}}</small></h2>
    <table class="table">
        <thead>
            <tr>
                <th style="color:#55595c;background-color:#eceeef">课程编号</th>
                <th style="color:#55595c;background-color:#eceeef">课程名称</th>
                <th style="color:#55595c;background-color:#eceeef">授课教师</th>
                <th style="color:#55595c;background-color:#eceeef">学期</th>
                <th style="color:#55595c;background-color:#eceeef">加入时间</th>
            </tr>
        </thead>
        <tbody>
        @foreach($lessonList as $lesson)
            <tr>
                <th class="scope">{{$lesson['lessonID']}}</th>
                <td>{{$lesson['lessonName']}}</td>
                <td>{{$lesson['teacherName']}}</td>
                <td>{{$lesson['semester']}}</td>
                <td>{{$lesson['time']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            // 更改sidebar的样式, 使当前页面显示为active
            $("#group").click();
            $("#myGroup").addClass("active");
        });
    </script>
@endsection
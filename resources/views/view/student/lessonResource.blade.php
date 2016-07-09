@extends('view.template.student_layout')

@section('main_panel')
    @parent
    <?php
    $lessonList = [
            ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季'],
            ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季'],
            ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季'],
            ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季'],
            ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季'],
    ];
    ?>
    <h1 class="page-header">课程资源</h1>
    <table class="table">
        <thead>
            <tr>
                <th style="color:#55595c;background-color:#eceeef">课程编号</th>
                <th style="color:#55595c;background-color:#eceeef">课程名称</th>
                <th style="color:#55595c;background-color:#eceeef">授课教师</th>
                <th style="color:#55595c;background-color:#eceeef">学期</th>
                <th style="color:#55595c;background-color:#eceeef"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($lessonList as $lesson)
            <tr>
                <th class="scope">{{$lesson['lessonID']}}</th>
                <td>{{$lesson['lessonName']}}</td>
                <td>{{$lesson['teacherName']}}</td>
                <td>{{$lesson['semester']}}</td>
                <td><button class="btn btn-success lessonResource" data-lesson-id="{{$lesson['lessonID']}}">课程资源</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            var baseURL = 'http://localhost/JWHelper/public/student';
            // 更改sidebar的样式, 使当前页面显示为active
            $(".nav-sidebar>li").removeClass("active");
            $("#resource").addClass("active");

            $(".lessonResource").click(function () {
                var lessonID = $(this).data('lessonId');
                location.href = baseURL + '/lessonResourceList?lessonID=' + lessonID;
            });
        });
    </script>
@endsection
@extends('view.template.student_layout')

@section('main_panel')
    @parent
    <h1 class="page-header">课程作业</h1>
    <table class="table">
        <thead>
            <tr>
                <th style="color:#55595c;background-color:#eceeef">课程编号</th>
                <th style="color:#55595c;background-color:#eceeef">课程名称</th>
                <th style="color:#55595c;background-color:#eceeef">授课教师</th>
                <th style="color:#55595c;background-color:#eceeef"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($lessons as $lesson)
            <tr>
                <th class="scope">{{$lesson->lessonID}}</th>
                <td>{{$lesson->lessonName}}</td>
                <td>{{$lesson->teacherName}}</td>
                <td><button class="btn btn-success lessonHomework" data-lesson-id="{{$lesson->lessonID}}" data-teacher-id="{{$lesson->teacherID}}">课程作业</button></td>
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
            $("#homework").addClass("active");

            //To do
            $(".lessonHomework").click(function () {
                var lessonID = $(this).data('lessonId');
                var teacherID = $(this).data('teacherId');
                location.href = baseURL + '/thomeworksList?lessonID=' + lessonID + '&teacherID=' + teacherID;
            });
        });
    </script>
@endsection
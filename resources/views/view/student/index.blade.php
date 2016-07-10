@extends('view.template.student_layout')

@section('main_panel')
    @parent
        <h1 class="page-header">课程列表</h1>
        <table class="table">
            <thead>
                <tr>
                    <th style="color:#55595c;background-color:#eceeef">课程编号</th>
                    <th style="color:#55595c;background-color:#eceeef">课程名称</th>
                    <th style="color:#55595c;background-color:#eceeef">授课教师</th>
                    <th style="color:#55595c;background-color:#eceeef">学期</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessonList as $lesson)
                    <tr>
                        <th class="scope">{{$lesson['lessonID']}}</th>
                        <td>{{$lesson['lessonName']}}</td>
                        <td>{{$lesson['teacherName']}}</td>
                        <td>{{$lesson['semester']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

@endsection

@section('bodyJS')
    @parent
    <script>
        // 更改sidebar的样式, 使当前页面显示为active
        $("#lessonList").addClass("active");

    </script>
@endsection
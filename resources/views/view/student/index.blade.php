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
                        <th class="scope">{{$lesson[0]}}</th>
                        <td>{{$lesson[1]}}</td>
                        <td>{{$lesson[2]}}</td>
                        <td>{{$lesson[3]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

@endsection
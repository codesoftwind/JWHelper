@extends('view.template.student_layout')

@section('main_panel')
    @parent
        <?php
            $courses = [
                ['001', '软件工程过程', '林广艳', '3'],
                ['002', 'C++高级程序设计', '谭火彬', '5'],
                ['003', '线性代数', 'Leo', '4']
            ];
        ?>
        <h1 class="page-header">课程列表</h1>
        <table class="table">
            <thead>
                <tr>
                    <th style="color:#55595c;background-color:#eceeef">课程编号</th>
                    <th style="color:#55595c;background-color:#eceeef">课程名称</th>
                    <th style="color:#55595c;background-color:#eceeef">授课教师</th>
                    <th style="color:#55595c;background-color:#eceeef">学分</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <th class="scope">{{$course[0]}}</th>
                        <td>{{$course[1]}}</td>
                        <td>{{$course[2]}}</td>
                        <td>{{$course[3]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
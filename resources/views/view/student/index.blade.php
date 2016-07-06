@extends('view.template.student_layout')

@section('main_panel')
    @parent
        <?php
            $lessonList = [
                    ['001', '软件工程过程', 'Leo', '2016年春季'],
                    ['002', 'C++高级程序设计', 'Messi', '2015年秋季'],
                    ['003', '数据结构', 'Jack', '2014年春季'],
                    ['004', '软件工程过程', 'Leo', '2016年春季'],
                    ['005', 'C++高级程序设计', 'Messi', '2015年秋季'],
                    ['006', '数据结构', 'Jack', '2014年春季'],
            ];
        ?>
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
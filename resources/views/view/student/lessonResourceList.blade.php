@extends('view.template.student_layout')

@section('main_panel')
    <?php
            $lessonName = '数据库结构';
            $lessonResource = [
                    ['迭代会议回顾模板.xls', '林广艳', '2016-07-09 16:22:30', '20KB'],
                    ['迭代会议回顾模板.xls', '林广艳', '2016-07-09 16:22:30', '20KB'],
                    ['迭代会议回顾模板.xls', '林广艳', '2016-07-09 16:22:30', '20KB'],
                    ['迭代会议回顾模板.xls', '林广艳', '2016-07-09 16:22:30', '20KB'],
            ];
    ?>
    @parent
    <h1 class="page-header">课程资源下载</h1>
    <h2 class="sub-header"><small>课程名称: {{$lessonName}}</small></h2>
    <table class="table">
        <thead>
            <tr>
                <th style="color:#55595c;background-color:#eceeef">文件名称</th>
                <th style="color:#55595c;background-color:#eceeef">创建者</th>
                <th style="color:#55595c;background-color:#eceeef">最后修改时间</th>
                <th style="color:#55595c;background-color:#eceeef">大小</th>
                <th style="color:#55595c;background-color:#eceeef"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($lessonResource as $resource)
            <tr>
                <th>{{$resource[0]}}</th>
                <td>{{$resource[1]}}</td>
                <td>{{$resource[2]}}</td>
                <td>{{$resource[3]}}</td>
                <td><button class="btn btn-success"><span><a href="#"></a></span>下载</button></td>
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
            $(".nav-sidebar>li").removeClass("active");
            $("#resource").addClass("active");
        });
    </script>
@endsection
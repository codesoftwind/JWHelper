@extends('view.template.student_layout')

@section('main_panel')
    @parent
    <?php
            $groupID = '1';
            $groupName = '一颗赛艇';
            $lessonList = [
                ['lessonID' => '001', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'status' => '0'],
                ['lessonID' => '002', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'status' => '2'],
                ['lessonID' => '003', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'status' => '1'],
                ['lessonID' => '004', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'status' => '0'],
                ['lessonID' => '005', 'lessonName' => '数据库结构', 'teacherName' => '黄坚', 'semester' => '2013春季', 'status' => '1'],
            ];
    ?>
    <h1 class="page-header">申请课程</h1>
    <h2 class="sub-header" id="groupName" data-group-id="{{$groupID}}"><small>团队名称: {{$groupName}}</small></h2>
    <table class="table">
        <thead>
            <tr>
                <th style="color:#55595c;background-color:#eceeef">课程编号</th>
                <th style="color:#55595c;background-color:#eceeef">课程名称</th>
                <th style="color:#55595c;background-color:#eceeef">授课教师</th>
                <th style="color:#55595c;background-color:#eceeef">学期</th>
                <th style="color:#55595c;background-color:#eceeef">申请状态</th>
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
                <td>
                    @if($lesson['status'] == 1)
                        {{'已申请待审核'}}
                    @elseif($lesson['status'] == 2)
                        {{'审核未通过'}}
                    @endif
                </td>
                <td><button class="btn btn-success apply-lesson-id" data-lesson-id="{{$lesson['lessonID']}}">申请课程</button></td>
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

            // To do
            $(".apply-lesson-id").click(function () {
                var lessonID = $(this).data('lessonId');
                var groupID = $("#groupName").data('groupId');
                // Test
                alert('lessonID: ' + lessonID + '\n' + 'groupID' + groupID);
            });
        });
    </script>
@endsection
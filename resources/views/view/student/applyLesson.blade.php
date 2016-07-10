@extends('view.template.student_layout')

@section('main_panel')
    @parent
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
        @foreach($toApply as $lesson)
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
                    @elseif($lesson['status'] == 0)
                        {{'可申请'}}
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
            var baseURL = 'http://localhost/JWHelper/public/student';
            // 更改sidebar的样式, 使当前页面显示为active
            $("#group").click();
            $("#myGroup").addClass("active");

            $(".apply-lesson-id").click(function () {
                var url = baseURL + '/groupApplyLesson';
                var data = {
                    'lessonID': $(this).data('lessonId'),
                    'groupID': $("#groupName").data('groupId')
                };
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data['status'] == 1) {
                            BootstrapDialog.show({
                                title: '申请成功',
                                type: BootstrapDialog.TYPE_SUCCESS,
                                buttons: [
                                    {
                                        label: '关闭',
                                        action: function (dialogItself) {
                                            dialogItself.close();
                                            location.reload();
                                        }
                                    }
                                ]
                            });
                        } else {
                            BootstrapDialog.show({
                                title: '申请失败',
                                type: BootstrapDialog.TYPE_WARNING,
                                buttons: [
                                    {
                                        label: '关闭',
                                        action: function (dialogItself) {
                                            dialogItself.close();
                                        }
                                    }
                                ]
                            });
                        }
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        BootstrapDialog.show({
                            title: '网络连接错误',
                            message: msg,
                            type: BootstrapDialog.TYPE_DANGER,
                            buttons: [
                                {
                                    label: '关闭',
                                    action: function(dialogItself) {
                                        dialogItself.close();
                                    }
                                }
                            ]
                        });
                    }
                });
            });
        });
    </script>
@endsection
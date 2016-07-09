@extends('view.student.group_layout')

@section('header', '审核团队')

@section('main_content')
    <table class="table">
        <thead>
        <tr>
            <th style="color:#55595c;background-color:#eceeef">申请人姓名</th>
            <th style="color:#55595c;background-color:#eceeef">团队名称</th>
            <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
            <th style="color:#55595c;background-color:#eceeef">团队现有人数</th>
            <th style="color:#55595c;background-color:#eceeef"></th>
            <th style="color:#55595c;background-color:#eceeef"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($checkList as $group)
            <tr>
                <th>{{$group->studentName}}</th>
                <th>{{$group->groupName}}</th>
                <th>{{$group->maxPeople}}</th>
                <th>{{$group->occupied}}</th>
                <th><button class="btn btn-success agree" data-group-id="{{$group->groupID}}" data-student-id="{{$group->studentID}}">同意</button></th>
                <th><button class="btn btn-danger disagree" data-group-id="{{$group->groupID}}" data-student-id="{{$group->studentID}}">拒绝</button></th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('bodyJS')
    @parent
    <script>
        var baseURL = 'http://localhost/JWHelper/public/student';
        $(function () {
             $(".agree").click(function () {
                 var url = baseURL + '/check';
                 var data = {
                     'groupID': $(this).data('groupId'),
                     'studentID': $(this).data('studentId'),
                     'agree': 1
                 };
                 $.ajax({
                     url: url,
                     type: "POST",
                     data: data,
                     dataType: "json",
                     success: function(data) {
                         if (data['status'] == 1) {
                             BootstrapDialog.show({
                                 title: '操作成功,已经同意该申请',
                                 type: BootstrapDialog.TYPE_SUCCESS,
                                 buttons: [
                                     {
                                         label: '关闭',
                                         action: function(dialogItself) {
                                             dialogItself.close();
                                             location.reload();
                                         }
                                     }
                                 ]
                             });
                         } else {
                             BootstrapDialog.show({
                                 title: '操作失败',
                                 message: '请再次进行操作',
                                 type: BootstrapDialog.TYPE_SUCCESS,
                                 buttons: [
                                     {
                                         label: '关闭',
                                         action: function(dialogItself) {
                                             dialogItself.close();
                                             location.reload();
                                         }
                                     }
                                 ]
                             });
                         }
                     }
                 });
             });

            $(".disagree").click(function () {
                var url = baseURL + '/check';
                var data = {
                    'groupID': $(this).data('groupId'),
                    'agree': 0
                };
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "json",
                    success: function(data) {
                        if (data['status'] == 1) {
                            BootstrapDialog.show({
                                title: '操作成功, 已经拒绝该申请',
                                type: BootstrapDialog.TYPE_SUCCESS,
                                buttons: [
                                    {
                                        label: '关闭',
                                        action: function(dialogItself) {
                                            dialogItself.close();
                                            location.reload();
                                        }
                                    }
                                ]
                            });
                        } else {
                            BootstrapDialog.show({
                                title: '操作失败',
                                message: '请再次进行操作',
                                type: BootstrapDialog.TYPE_SUCCESS,
                                buttons: [
                                    {
                                        label: '关闭',
                                        action: function(dialogItself) {
                                            dialogItself.close();
                                            location.reload();
                                        }
                                    }
                                ]
                            });
                        }
                    }
                });
            });

        });
    </script>
@endsection
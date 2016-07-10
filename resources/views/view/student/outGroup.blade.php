@extends('view.student.group_layout')

@section('header', '可加入的团队')

@section('main_content')
    <table class="table">
        <thead>
        <tr>
            <th style="color:#55595c;background-color:#eceeef">团队名称</th>
            <th style="color:#55595c;background-color:#eceeef">团队负责人</th>
            <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
            <th style="color:#55595c;background-color:#eceeef">团队现有人数</th>
            <th style="color:#55595c;background-color:#eceeef">申请状态</th>
            <th style="color:#55595c;background-color:#eceeef">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($toApply as $group)
            <tr>
                <th>{{$group['apply']->groupName}}</th>
                <th>{{$group['apply']->headName}}</th>
                <th>{{$group['apply']->maxPeople}}</th>
                <th>{{$group['apply']->occupied}}</th>
                <th>
                    @if ($group['status'] == 1)
                        {{'已申请待审核'}}
                    @elseif ($group['status'] == 2)
                        {{'审核未通过'}}
                    @endif
                </th>
                <th><button class="btn btn-primary apply" data-group-id="{{$group['apply']->groupID}}">申请加入</button></th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('bodyJS')
    @parent
    <script>
        // 更改sidebar的样式, 使当前页面显示为active
        $("#outGroup").addClass("active");

        var baseURL = 'http://localhost/JWHelper/public/student';
        $(function () {
            // To do
            $(".apply").click(function () {
                var groupID = $(this).data('groupId');
                var url = baseURL + '/apply';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'groupID': groupID},
                    dataType: "json",
                    success: function (data) {
                        if (data['status'] == 1) {
                            BootstrapDialog.show({
                                title: '申请成功',
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
                                title: '申请失败',
                                type: BootstrapDialog.TYPE_WARNING,
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
                    }
                });
            });
        });
    </script>
@endsection
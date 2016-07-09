@extends('view.template.student_layout')

@section('headjs')
    @parent
    <style>
        #groupName, #maxPeople {
            margin: 10px 0;
        }
    </style>
@endsection

@section('main_panel')
    @parent
    <div class="page-header">
        <h1>学生团队</h1>
    </div>
    <button class="btn btn-primary" id="createTeam"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 创建团队</button>
    <div class="sub-header">
        <h2><small>@yield('header')</small></h2>
    </div>
    @yield('main_content')

@endsection


@section('bodyJS')
    @parent
    <script>
        $(function() {

            var baseURL = 'http://localhost/JWHelper/public/student';
            // 显示团队列表下的标签
            $("#myGroup").removeClass("displayNone");
            $("#inGroup").removeClass("displayNone");
            $("#outGroup").removeClass("displayNone");

            // 创建团队表单
            $("#createTeam").click(function () {
                var dialogInstance = new BootstrapDialog({
                    title: '创建新的学习团队',
                    type: BootstrapDialog.TYPE_PRIMARY
                });

                var form = '<input type="text" name="groupName" id="groupName" class="form-control" placeholder="团队名称" required autofocus title="请填写团队名称">' +
                        '<input type="number" name="maxPeople" id="maxPeople" class="form-control" placeholder="团队人数上限(整数)" required title="请填写团队人数上限">';
                dialogInstance.setMessage(form);

                var buttons = [
                    {
                        label: '确定',
                        action: function(dialogItself) {
                            var groupName = $("#groupName").val();
                            var maxPeople = $("#maxPeople").val();
                            var formData = {
                                'groupName': groupName,
                                'maxPeople': maxPeople
                            };
                            $.ajax({
                                url: baseURL + '/groupForm',
                                type: 'POST',
                                data: formData,
                                success: function(data) {
                                    dialogItself.close();
                                    if (data['status'] == 1) {
                                        BootstrapDialog.show({
                                            title: '创建团队成功',
                                            type: BootstrapDialog.TYPE_SUCCESS,
                                            buttons: [
                                                {
                                                    label: '关闭',
                                                    action: function(dialogItself) {
                                                        dialogItself.close();
                                                        location.href = baseURL + '/myGroups';
                                                    }
                                                }
                                            ]
                                        });
                                    } else {
                                        BootstrapDialog.show({
                                            title: '创建团队失败',
                                            type: BootstrapDialog.TYPE_WARNING,
                                            message: '请重新创建团队',
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
                                },
                                dataType: 'json'
                            });
                            dialogItself.close();
                        }
                    }
                ];
                dialogInstance.setButtons(buttons);
                dialogInstance.open();
            });
        });
    </script>
@endsection
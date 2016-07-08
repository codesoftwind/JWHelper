@extends('view.template.student_layout')

@section('headjs')
    @parent
    <link rel="stylesheet" href="{{asset('css/bootstrap-dialog.min.css')}}">
    <script src="{{asset('js/bootstrap-dialog.min.js')}}"></script>
    <style>
        #groupName, #maxPeople {
            margin: 10px 0;
        }
    </style>
@endsection

@section('main_panel')
    @parent
    <div>
        <h1 class="page-header">学生团队</h1>
        <button class="btn btn-primary" id="createTeam"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 创建团队</button>
    </div>

    <h2 class="sub-header">@yield('header')</h2>
    @yield('main_content')

@endsection


@section('bodyJS')
    @parent
    <script>
        $(function() {
            // 更改sidebar的样式, 使当前页面显示为active
            $(".nav-sidebar>li").removeClass("active");
            $("#team").addClass("active");

            // 显示团队列表下的标签
            $("#myTeam").removeClass("displayNone");
            $("#inTeam").removeClass("displayNone");
            $("#outTeam").removeClass("displayNone");

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
                                url: 'http://localhost/JWHelper/public/student/groupForm',
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
                                                        location.reload();
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
@extends('view.template.student_layout')

@section('headjs')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
    <style>
        #groupName, #maxPeople {
            margin: 10px 0;
        }
    </style>
@endsection

@section('main_panel')
    @parent
        <?php
            $groups = [
                    ['第一个团队', 'Leo', '3'],
                    ['第二个团队', 'Messi', '4'],
                    ['第三个团队', 'Leo', '3'],
                    ['第四个团队', 'Jack', '6'],
                    ['第五个团队', 'Leo', '8'],
            ]
        ?>
        <div>
            <h1 class="page-header">学习团队</h1>
            <button class="btn btn-primary" id="createTeam">创建团队</button>
        </div>

        <h2 class="sub-header">已加入的团队</h2>
        <table class="table">
            <thead>
                <tr>
                    <th style="color:#55595c;background-color:#eceeef">团队名称</th>
                    <th style="color:#55595c;background-color:#eceeef">团队负责人</th>
                    <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
                    <th style="color:#55595c;background-color:#eceeef">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                    <tr>
                        <th>{{$group[0]}}</th>
                        <th>{{$group[1]}}</th>
                        <th>{{$group[2]}}</th>
                        <th><button class="btn btn-danger">退出团队</button></th>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="sub-header">可加入的团队</h2>
        <table class="table">
            <thead>
            <tr>
                <th style="color:#55595c;background-color:#eceeef">团队名称</th>
                <th style="color:#55595c;background-color:#eceeef">团队负责人</th>
                <th style="color:#55595c;background-color:#eceeef">团队人数上限</th>
                <th style="color:#55595c;background-color:#eceeef">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <th>{{$group[0]}}</th>
                    <th>{{$group[1]}}</th>
                    <th>{{$group[2]}}</th>
                    <th><button class="btn btn-primary">申请加入</button></th>
                </tr>
            @endforeach
            </tbody>
        </table>


@endsection

@section('bodyJS')
    <script>
        $(function() {
            // 更改sidebar的样式, 使当前页面显示为active
            $(".nav-sidebar>li").removeClass("active");
            $("#team").addClass("active");

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
                            console.log(formData);
                            $.ajax({
                                url: 'http://localhost/JWHelper/public/student/createTeam',
                                type: 'POST',
                                data: formData,
                                success: function(data) {

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
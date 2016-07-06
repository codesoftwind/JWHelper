@extends('view.template.student_layout')

@section('headjs')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
@endsection

@section('main_panel')
    @parent
        <div>
            <h1 class="page-header">学习团队</h1>
            <button class="btn btn-primary" id="createTeam">创建团队</button>
        </div>

@endsection

@section('bodyJS')
    <script>
        $(function() {
            // 更改sidebar的样式, 使当前页面显示为active
            $(".nav-sidebar>li").removeClass("active");
            $("#team").addClass("active");

            $("#createTeam").click(function () {
               var dialog =
            });
        });
    </script>
@endsection
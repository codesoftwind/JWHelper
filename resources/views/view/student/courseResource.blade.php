@extends('view.template.student_layout')

@section('main_panel')
    @parent

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
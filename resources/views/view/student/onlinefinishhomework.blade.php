@extends('view.template.student_layout')


@section('headjs')
    @parent
    <meta charset="utf-8">
 <!--    <link rel="stylesheet" type=”text/css”  href="public/css/neo.css">
    <link rel="stylesheet" type=”text/css”  href="public/css/samples.css"> -->
   <!--  <script type="text/javascript" src="../ckeditor.js"></script>
    <script type="text/javascript" src="../sample.js"></script> -->
    
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<!--     <script src="{{asset('js/sample.js')}}"></script>
 -->     
@endsection

@section('main_panel')
<main>
     <div class="grid-container">
            <div class="grid-width-90">
                <div id="editor">
                    <h1>在线提交作业</h1>
                    <textarea name="Xeditor" id="Xeditor"></textarea>
                    <script type="text/javascript">
                        CKEDITOR.replace('Xeditor');
                    </script>
                </div>

                <div class="row-fluid">

                        <div class="span4">

                        </div>

                        <div class="span8 invoice-block">

                            <br />

                            <a class="btn green big hidden-print">提交 <i class="m-icon-big-swapright m-icon-white"></i></a>

                            <a class="btn big hidden-print" href="Check_Assignment.html">&nbsp;&nbsp;取消&nbsp;&nbsp;</a>

                        </div>

                    </div>
            </div>
        </div>

</main>

@endsection
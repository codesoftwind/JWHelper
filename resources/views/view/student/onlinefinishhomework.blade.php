@extends('view.template.student_layout')


@section('headjs')
    @parent
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/bootstrap-dialog.min.css')}}">
    <script src="{{asset('js/bootstrap-dialog.min.js')}}"></script>
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>   
@endsection

@section('main_panel')
@parent
        <div>
            <h1 class="page-header">在线提交作业</h1>
        </div>
<main>
     <div class="grid-container">
            <div class="grid-width-90">
                <form action="http://localhost/JWHelper/public/student/uploadShomework" name="myform" method="post" enctype="multipart/form-data">
                    <div id="editor">
                        <textarea name="content" id="Xeditor"></textarea>
                         <script type="text/javascript">
                            CKEDITOR.replace('Xeditor');
                        </script>
                    </div>
                    <br />
                    <div class="form-group">
                        <input class="form-control" type="file" name="choose" id="InputFile">
                        <p class="help-block">请选择选课信息Excel文件并上传。</p>
                        <p>       <?php 
                        if(isset($success)) 
                            echo "上传成功";
                        elseif (isset($fail)) {
                            echo "上传失败";
                        }
                        else 
                            echo " ";  
                        ?>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-primary" id="createTeam">确认提交</button>
                </form>     `
            </div>
    </div>


</form>

</main>

@endsection
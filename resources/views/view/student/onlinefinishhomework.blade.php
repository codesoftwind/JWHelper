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


<!-- <?php
     
    $shomework=array('lessonID ' =>'2' , 'lessonName'=>'得到','shomeworkID'=>'5', 'content'=>'ftgfjhj', 'attachment'=>'', 'groupName'=>'ddy', 'grade'=>'-1', 'comment'=>'guake', 'attachmentName'=>'yyyyyy');
    $group = true
?> -->
@if($homework== null)
   <form>
    <h3>作业信息</h3>
    <dl class='dl-horizontal'>
        <dt>作业名称：</dt>
        <dt>作业详情：</dt>
        <dd></dd>
        <dt>作业开始时间：</dt>
        <dd></dd>
        <dt>作业结束时间：</dt>
        <dd></dd>
        <dt>分组情况：</dt>
        <dd></dd>
    </dl>
    <h3>学生作业内容</h3>
     <form action="http://localhost/JWHelper/public/student/uploadShomework" name="myform" method="post" enctype="multipart/form-data">
                    <div id="editor">
                        <textarea name="content" id="Xeditor" >
                        </textarea>
                        
                         <script type="text/javascript">
                            CKEDITOR.replace('Xeditor');
                        </script>
                    </div>
                    <br />
                    <div class="form-group">
                        <input class="form-control" type="file" name="choose" id="InputFile" defaultValue ="baidu.com">
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
                </form>
</form> 
@else
<form>
    <h3>作业信息</h3>
    <dl class='dl-horizontal'>
        <dt>作业名称：</dt>
        <dd>{{ $homework[0]->thomeworkName}}</dd>
        <dt>作业详情：</dt>
        <dd>{{ $homework[0]->description}}</dd>
        <dt>作业开始时间：</dt>
        <dd>{{ $homework[0]->startTime}}</dd>
        <dt>作业结束时间：</dt>
        <dd>{{ $homework[0]->endTime}}</dd>
        @if($homework[0]->group == true)
            <dt>分组情况：</dt>
            <dd>已分组</dd>
        @else
            <dt>分组情况：</dt>
            <dd>不分组</dd>
        @endif
    </dl>
    <h3>学生作业内容</h3>
     <form action="http://localhost/JWHelper/public/student/uploadShomework" name="myform" method="post" enctype="multipart/form-data">
                    <div id="editor">
                        <textarea name="content" id="Xeditor" >
                            <p>{{ $homework[0]->content}}</p>
                        </textarea>
                        
                         <script type="text/javascript">
                            CKEDITOR.replace('Xeditor');
                        </script>
                    </div>
                    <br />
                    <div class="form-group">
                        @if($homework[0]->attachmentName != '')
                        <table>
                            <tr><td>&nbsp</td></tr>
                            <tr>
                                <th width="100">已上交文件</th>
                                <td><a href="{{ $homework[0]->attachment}}">{{ $homework[0]->attachmentName}}</a></td>
                            </tr>
                            <tr><td>&nbsp</td></tr>
                        </table>
                        @else
                        @endif
                        <input class="form-control" type="file" name="choose" id="InputFile" value ="baidu.com">
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
                </form>
</form>
@endif

@endsection
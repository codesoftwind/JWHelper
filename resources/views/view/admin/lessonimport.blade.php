@extends('view.template.admin_layout')
@section('main_panel')

<div class="col-md-12 page-header">
	课程信息导入
</div>
<form action="http://localhost/JWHelper/public/admin/uploadLesson"  method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input class="form-control" type="file" name="lesson" id="InputFile">
    <p class="help-block">请选择课程信息Excel文件并上传。</p>
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
  <button type="submit" class="btn btn-default btn-primary" id="upload">上传</button>
</form>

@endsection
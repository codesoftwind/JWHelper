@extends('view.template.admin_layout')
@section('main_panel')

<div class="col-md-12 page-header">
	学生信息导入
</div>
<form action="http://localhost/JWHelper/public/admin/uploadStudent"  method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input class="form-control" type="file" name="student" id="InputFile">
    <p class="help-block">请选择学生信息Excel文件并上传。</p>
  </div>
  <button type="submit" class="btn btn-default btn-primary">上传</button>
</form>

@endsection
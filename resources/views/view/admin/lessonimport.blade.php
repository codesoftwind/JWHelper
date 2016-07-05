@extends('view.template.admin_layout')
@section('main_panel')

<div class="col-md-12 page-header">
	课程信息导入
</div>
<form action="admin/uploadLesson">
  <div class="form-group">
    <input class="form-control" type="file" name="lesson" id="InputFile">
    <p class="help-block">请选择课程信息Excel文件并上传。</p>
  </div>
  <button type="submit" class="btn btn-default btn-primary">上传</button>
</form>

@endsection
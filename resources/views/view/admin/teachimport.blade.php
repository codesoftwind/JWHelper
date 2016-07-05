@extends('view.template.admin_layout')
@section('main_panel')

<div class="col-md-12 page-header">
	授课信息导入
</div>
<form action="admin/uploadTeach">
  <div class="form-group">
    <input class="form-control" type="file" name="teach" id="InputFile">
    <p class="help-block">请选择授课信息Excel文件并上传。</p>
  </div>
  <button type="submit" class="btn btn-default btn-primary">上传</button>
</form>

@endsection
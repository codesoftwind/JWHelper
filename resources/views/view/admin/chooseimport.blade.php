@extends('view.template.admin_layout')
@section('main_panel')

<div class="col-md-12 page-header">
	选课信息导入
</div>
<form action="http://localhost/JWHelper/public/admin/uploadChoose"  method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input class="form-control" type="file" name="choose" id="InputFile">
    <p class="help-block">请选择选课信息Excel文件并上传。</p>

  </div>
  <button type="submit" class="btn btn-default btn-primary" id="upload">上传</button>
</form>


@endsection

@section('bodyJS')
<script type="text/javascript">
	$("#upload").click(function() {
		alert('上传成功');
	});
</script>
@endsection
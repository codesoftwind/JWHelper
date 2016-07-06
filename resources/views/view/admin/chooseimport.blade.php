@extends('view.template.admin_layout')

@section('headjs')
<script type="text/javascript">
    $(document).ready(function () {

        $('#success-alert').hide();
        $('#fail-alert').hide();
        $('#submit-change').click(function(){
        	var formdata = new FormData();
        	var fileObj = document.getElementById("InputFile").files; 
        	for (var i = 0; i < fileObj.length; i++)    
        	{
        		formdata.append("file" + i, fileObj[i]); 

        	}   
        	$.ajax({
        		type : "POST" ,
				url : "http://localhost/JWHelper/public/admin/uploadChoose" ,
				data : formdata, 
				contentType: false, //必须
    			processData: false, //必须
				success : function(data){
					alert("i");
					if (data['status'] == 1){
						$('#success-alert').fadeIn();
						setTimeout(function(){$("#success-alert").modal("hide")},2000);
					}
					else{
						$('#fail-alert').fadeIn();
					}
				}
        	});
        });
    });
</script>
@endsection


@section('main_panel')
<div id="success-alert" class="col-md-12">
		<div class="alert alert-success alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  修改成功
		</div>
	</div>
	<div id="fail-alert" class="col-md-12">
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  修改失败
		</div>
	</div>

<div class="col-md-12 page-header">
	选课信息导入 
</div>
<form id = "upload-form"   enctype="multipart/form-data"> 
  <div class="form-group">
    <input class="form-control" type="file" name="choose" id="InputFile">
    <p class="help-block">请选择选课信息Excel文件并上传。</p>
  </div>
  <button type="button" id="submit-change" class="btn btn-default btn-primary">上传</button>
</form>

@endsection
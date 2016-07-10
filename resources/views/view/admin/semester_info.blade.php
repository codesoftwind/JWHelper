@extends('view.template.admin_layout')

@section('headjs')
<script type="text/javascript">
    $(document).ready(function () {
        //$('#hospital').addClass('active');
        $('#success-alert').hide()
        $('#fail-alert').hide()
        $('#submit-change').click(function(){
        	$.ajax({
        		type : "POST" ,
				url : "http://localhost/JWHelper/public/admin/setSemester" ,
				dataType : 'json',
				data : {
					semesterID : $('#semesterID').val() ,
					semesterYear : $('#semesterYear').val() ,
					semesterWeek : $('#semesterWeek').val() ,
					basicInfo : $('#basicInfo').val()
				},	
				success : function(data){
					if (data.status == 1){
						$('#success-alert').fadeIn()
						setTimeout(function(){
							window.location.href = "http://localhost/JWHelper/public/admin/semester_info"
						},2000)
					}
					else
						$('#fail-alert').fadeIn()
				}
        	});
        });
    });
</script>
@endsection

@section('main_panel')
	
	<div class="page-header">
	  <h3>学期基本信息</h3>
	</div>
	<div class="well">
		<p>学期ID：{{ $semester->semesterID or "undefined" }}</p>
		<p>学年：{{ $semester->semesterYear or "undefined" }}</p>
		<p>本学期共{{ $semester->semesterWeek or "undefined" }}周</p>
		<p>{{ $semester->basicInfo or "undefined" }}</p>
	</div>	
	<button align="right" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modify-modal">修改</button>
	<div class="modal fade" id="modify-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">修改学期信息</h4>
	      </div>
	      <div class="modal-body">
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
	        	<label for="semesterID">学期ID</label>
	        	<input class="form-control" id="semesterID"/>
	        	<label for="semesterYear">学年</label>
	        	<input class="form-control" id="semesterYear"/>
	        	<label for="semesterWeek">学期周数</label>
	        	<input class="form-control" id="semesterWeek"/>
	        	<label for="basicInfo">基本信息</label>
	        	<textarea class="form-control" id="basicInfo"></textarea>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" id="submit-change" class="btn btn-primary">保存更改</button>
	      </div>
	    </div>
	  </div>
	</div>

@endsection

@section('bodyJS')
	@parent
	<script>
		$(function () {
			$(".nav-sidebar>li").removeClass('active');
			$("#semesterInfo").addClass('active');
		});
	</script>
@endsection
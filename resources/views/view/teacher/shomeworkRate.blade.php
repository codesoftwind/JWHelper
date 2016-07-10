
<?php
$thomework = $thomework[0];
$shomework = $shomework[0];
?>

@extends('view.template.teacher_layout')
@section('headjs')
<script type="text/javascript">
    $(document).ready(function () {
    	$('#success-alert').hide()
    	$('#fail-alert').hide()
        $('#submit-grade').click(function(){
        	$.ajax({
        		type : "POST" ,
				url : "http://localhost/JWHelper/public/teacher/shomeworkRate" ,
				dataType : 'json',
				data : {
					shomeworkID : {{ $shomework->shomeworkID }},
					grade : $('#grade').val() ,
					comment : $('#comment').val()
				},	
				success : function(data){
					if (data.status == 1){
						$('#success-alert').fadeIn()
						setTimeout(function(){
							window.location.href = "http://localhost/JWHelper/public/teacher/thomework"
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
<div class="page-header">
	<h3>作业信息</h3>
</div>
	<table>
		<tr>
		<th>课程名称：</th>
		<td>{{ $thomework->thomeworkName}}</td>
		</tr>

		<tr>
		<th>作业详情：</th>
		<td>{{ $thomework->description}}</td>
		</tr>

		@if($group == true)
		<tr>
			<th>作业要求：</th>
			<td>团队完成</td>
		</tr>

		<tr>
			<th>团队名称：</th>
			<td>{{ $shomework->groupName}}</td>
		</tr>
		@else
		<tr>
			<th>作业要求：</th>
			<td>个人完成</td>
		</tr>

		<tr>
			<th>学生ID：</th>
			<td>{{ $shomework->studentID}}</td>
		</tr>

		<tr>
			<th>学生姓名：</th>
			<td>{{ $shomework->studentName}}</td>
		</tr>
		@endif
	</table>
<div class="page-header">
	<h3>学生作业内容</h3>
</div>
<div style="width:80%" class="well">
	<p>
		{{ $shomework->content}}
	</p>
</div>
<div class="page-header">
	<h3>学生作业附件</h3>
</div><p>
		<a href="{{ $shomework->attachment}}">{{ $shomework->attachmentName}}</a></p>
<div class="row">
@if($shomework->grade==-1)
<div class="col-md-12 form-group">
	<label for="grade">
		<h3>作业评分</h3></label>
		<input  class="form-control" type="number" name="grade" id="grade" min="0" max="100" placeholder="请输入0~100的分数" style="width:80%" />
	<label for="comment">
		<h3>作业评语</h3></label>
		<textarea style="width:80%" placeholder="请写下您的评语" class="form-control" name="comment" id="comment" rows="4"></textarea>
</div>
	<div class="col-md-2">
	<button id="submit-grade" type="submit" class="btn btn-primary">提交</button>
	</div>
@else

<div class="col-md-12 form-group">
	<label for="grade">
		<h3>作业评分</h3></label>
		<input  class="form-control" type="number" name="grade" id="grade" min="0" max="100" placeholder="请输入0~100的分数" value="{{$shomework->grade}}" style="width:80%" />
	
	<label for="comment">
		<h3>作业评语</h3></label>
		<textarea style="width:80%" placeholder="请写下您的评语" class="form-control" name="comment" id="comment"  rows="4">{{$shomework->comment}}</textarea>
</div>
	<div class="col-md-2">
	<button id="submit-grade" type="submit" class="btn btn-primary">提交</button>
	</div>

@endif
    <div class="col-md-2">
    <button  type="submit" class="btn btn-success">返回</button>
    </div>
</div>


@endsection
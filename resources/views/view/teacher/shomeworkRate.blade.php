
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
					if (data['status'] == 1) {
						BootstrapDialog.show({
							title: '评分成功',
							type: BootstrapDialog.TYPE_SUCCESS,
							buttons: [
								{
									label: '关闭',
									action: function (dialogItself) {
										dialogItself.close();
										location.reload();
									}
								}
							]
						});
					} else {
						BootstrapDialog.show({
							title: '评分失败',
							type: BootstrapDialog.TYPE_WARNING,
							buttons: [
								{
									label: '关闭',
									action: function (dialogItself) {
										dialogItself.close();
									}
								}
							]
						});
					}
				}
        	});
        });
        $('#return-btn').click(function(){
        	window.location.href = "http://localhost/JWHelper/public/teacher/thomework"
        })
    });
</script>
@endsection

@section('main_panel')
	<div class="page-header">
	<h3>作业信息</h3>
</div>
	<table>
		<tr>
		<th>课程名称：</th>
		<td>{{ $thomework->thomeworkName}}</td>
		</tr>

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
		<td>{{ $thomework->description }}</td>
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
		{!! $shomework->content !!}
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
    <form action="http://localhost/JWHelper/public/teacher/thomework" method="post">
    <input type="hidden" name="thomeworkID" value={{ $thomework->thomeworkID }}>
    <button  type="submit" id="return-btn" class="btn btn-success">返回</button>
    </form>
    </div>
</div>


@endsection
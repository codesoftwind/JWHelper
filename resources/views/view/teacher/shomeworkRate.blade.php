@extends('view.template.teacher_layout')
@section('headjs')
<script type="text/javascript">
    $(document).ready(function () {
        $('#submit-grade').click(function(){
        	$.ajax({
        		type : "POST" ,
				url : "http://localhost/JWHelper/public/teacher/shomeworkRate" ,
				dataType : 'json',
				data : {

					grade : $('#grade').val() ,
					comment : $('#comment').val() ,
				},	
				success : function(data){
					if (data.status == 1){
						alert("提交成功")
					}
					else
						alert("提交失败")
				}
        	});
        });
    });
</script>
@endsection

@section('main_panel')

<?php
	$thomework=array('thomeworkName' =>'2' , 'description'=>'得到','thomeworkID'=>'2321');
	$shomework=array('lessonID ' =>'2' , 'lessonName'=>'得到','shomeworkID'=>'5', 'content'=>'ftgfjhj', 'attachment'=>'', 'groupName'=>'ddy', 'grade'=>'-1', 'comment', 'attachmentName'=>'yyyyyy');
	$group = true
?>


<form>
	<h3>作业信息</h3>
	<dl class='dl-horizontal'>
		<dt>课程名称：</dt>
		<dd>{{ $thomework['thomeworkName']}}</dd>
		<dt>作业详情：</dt>
		<dd>{{ $thomework['description']}}</dd>
		@if($group == true)
			<dt>作业要求：</dt>
			<dd>团队完成</dd>
			<dt>团队名称：</dt>
			<dd>{{ $shomework['groupName']}}</dd>
		@else
			<dt>作业要求：</dt><dd>个人完成</dd>
			<dt>学生ID：</dt><dd>{{ $shomework['studentID']}}</dd>
			<dt>学生姓名：</dt><dd>{{ $shomework['studentName']}}</dd>
		@endif
	</dl>
	<h3>学生作业内容</h3>
	<div class="form-group">
		<p style="background-color:#E7E8ED;width:80%" >
			{{ $shomework['content']}}
		</p>
	</div>
	<h3>学生作业附件</h2>
	<div class="form-group">
		<a href="{{ $shomework['attachment']}}">{{ $shomework['attachmentName']}}</a>
	</div>
</form>

<form class="form-group" action="http://localhost/JWHelper/public/teacher/shomeworkRate" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<h3>作业评分</h3>
		<input  class="form-control" type="number" name="grade" id="grade" min="0" max="100" placeholder="请输入0~100的分数" style="width:80%" />

	</div>
	<div class="form-group">
		<h3>作业评语</h3>
		<textarea style="width:80%" placeholder="请写下您的评语" class="form-control" name="comment" id="comment" rows="4"></textarea>
	</div>
	<button id="submit-grade" type="submit" class="btn btn-primary">提交</button>
	
</form>
<form action='http://localhost/JWHelper/public/teacher/thomework' method="post" enctype="multipart/form-data">
    <input type="hidden" name="thomeworkID" value="{{ $thomework['thomeworkID']}}">
    <button  type="submit" class="btn btn-success">返回</button>
</form>


@endsection
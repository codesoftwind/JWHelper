@extends('view.template.teacher_layout')

@section('main_panel')
<div class="row" style="background-color:#E7E8ED">
 	<div class="col-md-4 text-center" style='font-weight: bold;font-size:1.5em;'>团队名称</div>
 	<div class="col-md-4 text-center" style='font-weight: bold;font-size:1.5em'>团队负责人</div>
</div>
@foreach($groups as $group)
<div class="row">
	<div class="col-md-4 text-center" style='font-size:1.0em;padding-top: 1em;word-wrap:break-word'>{{$group->groupName}}</div>
  	<div class="col-md-4 text-center" style='font-size:1.0em;padding-top: 1em;word-wrap:break-word'>{{$group->headName}}</div>
 	<div class="col-md-4 " style='font-size:1.0em;padding:0.5em'>
 		<form action='http://localhost/JWHelper/public/teacher/group', method="post", enctype="multipart/form-data">
  			<input type="hidden" name="groupID", value="{{ $group->groupID}}">
  			<button type="submit" class="btn btn-primary" id="submit-change" >查看</button>
  		</form>
 	</div>
</div>
@endforeach
@endsection
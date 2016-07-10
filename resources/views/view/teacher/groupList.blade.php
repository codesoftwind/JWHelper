@extends('view.template.teacher_layout')


@section('main_panel')
<div class="page-header">
  <h3>团队</h3>
</div>
<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">$title</div>
	<table class="table table-striped">
	 <tr>
	    <th>团队名称</th>
	    <th>团队负责人</th>
	    <th></th>
	  </tr>



       @foreach ($groups as $group)
           <tr> 
           <td>{{  $group->groupName }}</td>
           <td>{{  $group->headName }}</td>  

			<td>
			  <div class="btn-group" role="group" aria-label="...">
				  <form action="http://localhost/JWHelper/public/teacher/thomework" method="post" enctype="multipart/form-data">
				  <input type="hidden" name="thomeworkID" value="{{ $thomework->thomeworkID }}">
				  <button type="submit" class="btn btn-sm btn-primary" >查看详情</button>
				  </form> 
				</div>
			</td>    
           </tr>  
       @endforeach
@endsection
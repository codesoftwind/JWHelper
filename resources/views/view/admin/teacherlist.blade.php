@extends('view.template.admin_layout')

@section('main_panel')
<div class="page-header">
	<h3>教师列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>职工号</th>
    <th>姓名</th>
    <th></th>
    <th></th>
  </tr>

  			<?php 
  				//$teacher=[["1", "Leo"], ["2", "Messi"]];
  				$teacher = $result;
  				//$lesson['lessonName']ghghg
  			?>

      @foreach ($teacher as $teacher)
<tr> 
      <td>{{  $teacher->teacherID }} </td>

           <td>{{ $teacher->teacherName }}</td>      
<td>
  <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-primary" >修改</button>
</div>
</td>
<td>
  <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-default" >删除</button>
</div>
 </td>
  </tr>  
       @endforeach



</table>
</div>

@endsection
@extends('view.template.admin_layout')

@section('main_panel')
<div class="page-header">
	<h3>学生列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>学号</th>
    <th>姓名</th>
    <th></th>
    <th></th>
  </tr>

  			<?php 
  				//$student=[["1", "Leo"], ["2", "Messi"]];
  				$student = $result;
  				//$lesson['lessonName']ghghg
  			?>

      @foreach ($student as $student)
<tr> 
      <td>{{  $student->studentID }} </td>

           <td>{{ $student->studentName }}</td>      
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
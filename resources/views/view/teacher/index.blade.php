@extends('view.template.teacher_layout')
@section('main_panel')
<div class="page-header">
  <h3>课程列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
   		<th>课程名</th>
    	<th>学生人数</th>
    	<th></th>
 	</tr>

        <?php 
        
          $lessons = $result;
        ?>

       @foreach ($lessons as $lesson)
           <tr> 
           <td>{{  $lesson->lessonName }}
           </td>

           <td>{{  $lesson->teacherName }}</td>      
<td>
  <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-primary" >查看</button>
</div>
</td>

           </tr>  
       @endforeach



</table>
</div>

@endsection
@extends('view.template.student_layout')

@section('main_panel')
<div class="page-header">
  <h3>课程列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>课程</th>
    <th>教师</th>
    <th></th>
  </tr>

        <?php 

          $lessons = $result;
        ?>

       @foreach ($lessons as $lesson)
           <tr> <td>{{  $lesson->lessonName }}
           </td>

           <td>{{  $lesson->teacherName }}</td>      
<td>
  <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-default" >退课</button>
</div>
</td>
           </tr>  
       @endforeach



</table>
</div>

@endsection
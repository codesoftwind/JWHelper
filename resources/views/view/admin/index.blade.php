@extends('view.template.admin_layout')

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
    <th></th>
  </tr>

        <?php 
          
          //$lesson = $result;
          //$lesson['lessonName']
        ?>

       @foreach ($lesson as $lesson)
           <tr> <td>{{  $lesson[0] }}
           </td>

           <td>{{  $lesson[1] }}</td>      
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

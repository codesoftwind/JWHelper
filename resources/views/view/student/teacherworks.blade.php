@extends('view.template.student_layout')

@section('main_panel')
<div class="page-header">
  <h3>作业列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>作业名称</th>
    <th>开始时间</th>
    <th>结束时间</th>
    <th>是否完成</th>
    <th>教师评分</th>
    <th></th>
  </tr>

        <?php 
           //$lessons=[["1","大","7.1","7.2",'','','1'],["2","小","7.5","7.6",'t','','-1']];
          $thomeworks = $result;
        ?>

       @foreach ($thomeworks as $thomework)
           <tr> 
           <td>{{  $thomework->homeworkName }}</td>  
           <td>{{  $thomework->startTime }}</td> 
           <td>{{  $thomework->endTime }}</td>

@if ($thomework->content != ''||$thomework->attachment != '')
       <td>是</td>
   @else
      <td>否</td>
   @endif

@if ($thomework->grade>=0 )
       <td>{{  $thomework->grade }}</td>
   @else
      <td>未评分</td>
   @endif

<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="$shomeworkID", value="{{ $shomework->shomeworkID}}">
  <button type="submit" class="btn btn-primary" id="submit-change" >查看详情</button>
  </form>
  
</div>
</td> 
           </tr>  
       @endforeach
</table>
</div>

@endsection
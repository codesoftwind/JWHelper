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
    <th>教师评分</th>
    <th></th>
  </tr>

        <?php 
           $thomeworks=[["1","大","7.1","1",'','','1'],["2","小","7.5","7.6",'t','','-1']];
         
           
          $i=-1;
        ?>
       @foreach ($thomeworks as $thomework)
            <?php 
            $i++;
            ?>
           <tr> 
           <td>{{  $thomework->thomeworkName }}</td>  
           <td>{{  $thomework->startTime }}</td> 
           <td>{{  $thomework->endTime }}</td>
           
@if(!empty($shomeworks[$i]))
    @if ($thomework->grade >= 0 )
       <td>{{  $thomework->grade }}</td>
    @else
       <td>未评分</td>
    @endif

@else
    <td>未评分</td>
@endif
           <?php 
           $t=strtotime($thomework->endTime);
           $time = time();
           date("y-m-d H:i:s",$time);
          ?>

@if ($time > $t)
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomeworkView', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $shomeworks[$i]->shomeworkID}}">
  <button type="submit" class="btn btn-primary" id="submit-change" >查看详情</button>
  </form>
  
</div>
</td> 
    @else
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomeworkEdit', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $shomeworks[$i]->shomeworkID }}">
  <button type="submit" class="btn btn-primary" id="submit-change" >编辑</button>
  </form>
</div>
</td>
      @endif
           </tr>  
       @endforeach
</table>
</div>

@endsection
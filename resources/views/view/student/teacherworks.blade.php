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
           
<?php 
           $t=strtotime($thomework->endTime);
           $time = time();
           date("y-m-d H:i:s",$time);
          ?>

@if(count($shomeworks[$i])!=0)
    @if ($shomeworks[$i][0]->grade >= 0 )
       <td>{{  $shomeworks[$i][0]->grade }}</td>
    @else
       <td>未评分</td>
    @endif
    @if ($time > $t)
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $shomeworks[$i][0]->shomeworkID}}">
  <input type="hidden" name="flag"  value=1>
  <button type="submit" class="btn btn-primary" id="submit-change" >查看详情</button>
  </form>
  
</div>
</td> 
    @else
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $shomeworks[$i][0]->shomeworkID }}">
  <input type="hidden" name="flag"  value=0>
  <button type="submit" class="btn btn-primary" id="submit-change" >编辑</button>
  </form>
</div>
</td>
      @endif

@else
    <td>未评分</td>
    @if ($time > $t)
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="thomeworkID", value="{{ $thomework->thomeworkID}}">
  <input type="hidden" name="flag"  value=1>
  <button type="submit" class="btn btn-primary" id="submit-change" >查看详情</button>
  </form>
  
</div>
</td> 
    @else
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="thomeworkID", value="{{ $thomework->thomeworkID }}">
  <input type="hidden" name="flag"  value=0>
  <button type="submit" class="btn btn-primary" id="submit-change" >编辑</button>
  </form>
</div>
</td>
      @endif
@endif
           
           </tr>  
       @endforeach
</table>
</div>

@endsection
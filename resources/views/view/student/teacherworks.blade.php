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
       @foreach ($groupHomework as $thomework)
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

@if(count($sgroupHomework[$i])!=0)
    @if ($sgroupHomework[$i][0]->grade >= 0 )
       <td>{{  $sgroupHomework[$i][0]->grade }}</td>
    @else
       <td>未评分</td>
    @endif
    @if ($time > $t)
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $sgroupHomework[$i][0]->shomeworkID}}">
  <input type="hidden" name="groupID" value="{{$groupID}}">
  <input type="hidden" name="flag"  value=1>
  <button type="submit" class="btn btn-primary" id="submit-change" >查看详情</button>
  </form>
  
</div>
</td> 
    @else
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $sgroupHomework[$i][0]->shomeworkID }}">
  <input type="hidden" name="groupID" value="{{$groupID}}">
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
  <input type="hidden" name="groupID" value="{{$groupID}}">
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
  <input type="hidden" name="groupID" value="{{$groupID}}">
  <button type="submit" class="btn btn-primary" id="submit-change" >编辑</button>
  </form>
</div>
</td>
      @endif
@endif
           
           </tr>  
       @endforeach



    <?php 
          $i=-1;
        ?>
       @foreach ($singleHomework as $thomework)
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

@if(count($ssingleHomework[$i])!=0)
    @if ($ssingleHomework[$i][0]->grade >= 0 )
       <td>{{  $ssingleHomework[$i][0]->grade }}</td>
    @else
       <td>未评分</td>
    @endif
    @if ($time > $t)
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $ssingleHomework[$i][0]->shomeworkID}}">
  <input type="hidden" name="flag"  value=1>
  <button type="submit" class="btn btn-primary" id="submit-change" >查看详情</button>
  </form>
  
</div>
</td> 
    @else
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/student/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $ssingleHomework[$i][0]->shomeworkID }}">
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

@section('bodyJS')
    @parent
    <script>
        $(function () {
            // 更改sidebar的样式, 使当前页面显示为active
            $("#homework").addClass("active");
        });
    </script>
@endsection
@extends('view.template.teacher_layout')

@section('main_panel')
<div class="page-header">
  <h3>作业详情</h3>
</div>
        <?php 
           //$thomeworks = ['thomeworkID','thomeworkName','lessonID','lessonName','description','startTime','endTime','1'];

          //$lessons = $result;
        ?>
<p>作业名：{{$thomework[0]->thomeworkName}}</p>
<p>课程名：{{$thomework[0]->lessonName}}</p>
<p>作业详情：{{$thomework[0]->description}}</p>
<p>开始时间：{{$thomework[0]->startTime}}</p>
<p>结束时间：{{$thomework[0]->endTime}}</p>


@if ($thomework[0]->group)
       <p>团队作业：是</p>
<h4>提交作业</h4>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
   		<th>团队名</th>
    	<th>负责人</th>
    	<th>作业评分</th>
    	<th></th>
 	</tr>

        <?php 
        //$shomeworks = [['grade', 'shomeworkID', '哈', 'headID', '李'],['grade', 'shomeworkID', '啊', 'headID', '王']];
        ?>

       @foreach ($shomework as $shomeworkt)
    <tr> 
           <td>{{  $shomeworkt->groupName }}
           </td>
           <td>{{  $shomeworkt->headName }}
           </td>
          @if ($shomeworkt->grade >0)
      <td>{{  $shomeworkt->grade }}
           </td>
          @else
           <td>
           </td>
           @endif
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/teacher/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $shomeworkt->shomeworkID}}">
  <button type="submit" class="btn btn-primary" id="submit-change" >查看</button>
  </form>
  
</div>
</td>
    </tr>  
       @endforeach
</table>
</div>
   @else
        <p>团队作业：否</p>
        <h4>提交作业</h4>
        <div class="table-responsive">
<table class="table table-striped">
	<tr>
   		<th>学号</th>
    	<th>学生名</th>
    	<th>作业评分</th>
    	<th></th>
 	</tr>

        <?php 
       //$shomeworks = [['grade', 'shomeworkID', '1', '王'],['grade', 'shomeworkID', '2', '李']];
        ?>

       @foreach ($shomework as $shomeworkt)
           <tr> 
           <td>{{  $shomeworkt->studentID }}
           </td>
           <td>{{  $shomeworkt->studentName}}
           </td>
           @if ($shomeworkt->grade >0)
      <td>{{  $shomeworkt->grade }}
           </td>
          @else
           <td>
           </td>
           @endif
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/teacher/shomework', method="post", enctype="multipart/form-data">
  <input type="hidden" name="shomeworkID", value="{{ $shomeworkt->shomeworkID}}">
  <button type="submit" class="btn btn-primary" id="submit-change" >查看</button>
  </form>
</div>
</td>
           </tr>  
       @endforeach
</table>
</div>
   @endif

@endsection
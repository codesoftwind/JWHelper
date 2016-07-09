@extends('view.template.teacher_layout')


@section('main_panel')

<div class="page-header">
  <h3>作业列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>课程名称</th>
    <th>作业名称</th>
    <th>开始时间</th>
    <th>结束时间</th>
    <th></th>
  </tr>

        <?php 
           //$lessons=[["1","大","7.1","7.2"],["2","小","7.5","7.6"]];
          $lessons = $result;
        ?>

       @foreach ($lessons as $lesson)
           <tr> 
           <td>{{  $lesson->lessonName }}</td>
           <td>{{  $lesson->homeworkName }}</td>  
           <td>{{  $lesson->startTime }}</td> 
           <td>{{  $lesson->endTime }}</td> 

<td>
  <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-primary" >查看详情</button>
</div>
</td>    
           </tr>  
       @endforeach
</table>
</div>
<button align="right" class="btn btn-default btn-md" data-toggle="modal" data-target="#modify-modal">上传作业</button>

	<div class="modal fade" id="modify-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	        <h4 class="modal-title" id="myModalLabel">作业信息</h4>
	      </div>
	      <div class="modal-body">
	        	<label for="semesterID">课程ID</label>
	        	<input class="form-control" id="semesterID"/>
	        	<label for="semesterYear">课程名称</label>
	        	<input class="form-control" id="semesterYear"/>
	        	<label for="semesterWeek">开始时间</label>
	        	<input class="form-control" id="semesterWeek"/>
	        	<label for="semesterWeek">结束时间</label>
	        	<input class="form-control" id="semesterWeek"/>
	        	<label for="basicInfo">基本信息</label>
	        	<textarea class="form-control" id="basicInfo"></textarea>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" id="submit-change" class="btn btn-primary">保存更改</button>
	      </div>
	    </div>
	  </div>
	</div>

@endsection
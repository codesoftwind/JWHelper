@extends('view.template.teacher_layout')

@section('headjs')
<script type="text/javascript">
    $(document).ready(function () {
        //$('#hospital').addClass('active');
        $('#success-alert').hide()
        $('#fail-alert').hide()
        $('#submit-change').click(function(){
          alert($('#isGroup').val())
        	$.ajax({
        		type : "POST" ,
    				url : "http://localhost/JWHelper/public/teacher/thomeworkPublish" ,
    				dataType : 'json',
    				data : {
    					thomeworkName : $('#workName').val() ,
    					startTime : $('#startTime').val() ,
    					endTime : $('#endTime').val() ,
    					description : $('#basicInfo').val() ,
    					group : $('#isGroup').val()
    				},	
    				success : function(data){
    					if (data.status == 1){
    						$('#success-alert').fadeIn()
    						setTimeout(function(){
    							window.location.href = "http://localhost/JWHelper/public/teacher/homework"
    						},2000)
    					}
    					else
    						$('#fail-alert').fadeIn()
    				}
          });
        });
    });
</script>
@endsection

@section('main_panel')

<div class="page-header">
  <h3>作业</h3>
</div>
<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">作业列表</div>
	<table class="table table-striped">
	 <tr>
	    <th>课程名称</th>
	    <th>作业名称</th>
	    <th>开始时间</th>
	    <th>结束时间</th>
	    <th></th>
	  </tr>
    @if(isset($result))
       @foreach ($result as $lesson)
           <tr> 
           <td>{{  $lesson->lessonName }}</td>
           <td>{{  $lesson->thomeworkName }}</td>  
           <td>{{  $lesson->startTime }}</td> 
           <td>{{  $lesson->endTime }}</td> 

			<td>
			  <div class="btn-group" role="group" aria-label="...">
				  <form action="http://localhost/JWHelper/public/teacher/thomework" method="post" enctype="multipart/form-data">
				  <input type="hidden" name="thomeworkID" value="{{ $lesson->thomeworkID }}">
				  <button type="submit" class="btn btn-sm btn-primary" >查看详情</button>
				  </form> 
				</div>
			</td>    
           </tr>  
       @endforeach
    @endif
</table>
</div>
<button align="right" class="btn btn-success btn-md" data-toggle="modal" data-target="#modify-modal">布置作业</button>

<div class="modal fade" id="modify-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">作业信息</h4>
      </div>
      <div class="modal-body">
      	<div id="success-alert" class="col-md-12">
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              发布成功
            </div>
        </div>
        <div id="fail-alert" class="col-md-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              发布失败
            </div>
        </div>
    	<label for="workName">作业名称</label>
    	<input class="form-control" id="courseName"/>
    	<label for="startTime">开始日期</label>
    	<div class="input-append date form_datetime row">
        <div class="col-md-9">
            <input class="form-control" type="date" data-format="yyyy-MM-dd" id="startTime" value="" readonly
                   required>
        </div>
        <div class="col-md-3">
            <span class="add-on"><button id="date1_btn" class="btn btn-default btn-info">选择日期
            </button></span>
            <script type="text/javascript">
                $(function () {
                    $('.date').datetimepicker({
                      maskInput: false
                    });
                });
            </script>
        </div>
      </div>
    	<label for="endTime">结束日期</label>
    	<div class="input-append date form_datetime row">
        <div class="col-md-9">
            <input class="form-control" type="date" data-format="yyyy-MM-dd" id="endTime" value="" readonly
                   required>
        </div>
        <div class="col-md-3">
            <span class="add-on"><button id="date2_btn" class="btn btn-default btn-info">选择日期
            </button></span>
            <script type="text/javascript">
                $(function () {
                    $('.date').datetimepicker({
                      maskInput: false
                    });
                });
            </script>
        </div>
      </div>
      <br />
        <select class="form-control" id="isGroup"/>
            <option value="1" selected>团队作业</option>
            <option value="0">个人作业</option>
        </select>
    	<label for="basicInfo">基本信息</label>
    	<textarea class="form-control" id="basicInfo"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
        <button type="button" id="submit-change" class="btn btn-success">保存更改</button>
      </div>
    </div>
  </div>
</div>

@endsection
@extends('view.template.admin_layout')

@section('main_panel')
	<div class="page-header">
	  <h3>学期基本信息</h3>
	</div>
	<div class="well">
		<p>学期ID：{{ $semesterID or "undefined" }}</p>
		<p>学年：{{ $semesterYear or "undefined" }}</p>
		<p>本学期共{{ $semesterWeek or "undefined" }}周</p>
		<p>{{ $basicInfo or "undefined" }}</p>
	</div>
	<button align="right" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modify-modal">修改</button>
	<div class="modal fade" id="modify-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">修改学期信息</h4>
	      </div>
	      <div class="modal-body">
	        	<label for="semesterID">学期ID</label>
	        	<input class="form-control" id="semesterID"/>
	        	<label for="semesterYear">学年</label>
	        	<input class="form-control" id="semesterYear"/>
	        	<label for="semesterWeek">学期周数</label>
	        	<input class="form-control" id="semesterWeek"/>
	        	<label for="basicInfo">基本信息</label>
	        	<textarea class="form-control" id="basicInfo"></textarea>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary">保存更改</button>
	      </div>
	    </div>
	  </div>
	</div>

@endsection
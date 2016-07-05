@extends('view.template.admin_layout')

@section('main_panel')
	<div class="container">
	<div class="row">
	<div class="page-header">
	  <h1>学期基本信息</h1>
	</div>
	<div class="well">
		<h3>学期ID：{{ $semesterID or "undefined" }}</h3>
		<h3>学年：{{ $semesterYear or "undefined" }}</h3>
		<h3>本学期共{{ $semesterWeek or "undefined" }}</h3>
		<h3>{{ $basicInfo or "undefined" }}</h3>
	</div>
	<button align="right" class="btn btn-primary btn-lg" data-toggle="modal" data-target="modify-modal">修改</button>
	<div class="modal fade" id="modify-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">修改学期信息</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
</div>

@endsection
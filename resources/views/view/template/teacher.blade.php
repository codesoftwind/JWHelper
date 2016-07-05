@extends('view.template.layout')

@section('sidebar')
	@parent
	<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
      <li class="active"><a href="#">课程列表 <span class="sr-only">(current)</span></a></li>
    </ul>
    <ul class="nav nav-sidebar">
      <li><a href="">资源列表</a></li>
      <li><a href="">资源分类标签</a></li>
      <li><a href="">作业列表</a></li>
      <li><a href="">团队列表</a></li>
      <li><a href="">在线交流</a></li>
    </ul>
  </div>
@endsection
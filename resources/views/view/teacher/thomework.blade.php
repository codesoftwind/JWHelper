@extends('view.template.teacher_layout')

@section('headjs')
<script type="text/javascript">
$(document).ready(function(){
  $('#progress-alert').hide()
  $('#success-alert').hide()
  $('#massDownload').click(function(){
    $('#alert-info').text("开始下载……")
    $('#progress-alert').fadeIn()
    @foreach($attatchments as $url)
    $.get("demo_ajax_load.txt", function(result){
      $('#alert-info').text($url + "下载完毕，准备下载下一附件")
    })
    @endforeach
    $('#progress-alert').fadeOut()
    $('#success-alert').fadeIn()
  })
})
</script>
@endsection

@section('main_panel')
<div class="page-header">
  <h3>作业详情</h3>
</div>
<div class="well">
  <p>作业名：{{$thomework[0]->thomeworkName}}</p>
  <p>课程名：{{$thomework[0]->lessonName}}</p>
  <p>作业详情：{{$thomework[0]->description}}</p>
  <p>开始时间：{{$thomework[0]->startTime}}</p>
  <p>结束时间：{{$thomework[0]->endTime}}</p>
  @if ($thomework[0]->group)
  <p>团队作业：是</p>
  @else
  <p>团队作业：否</p>
</div>
<div id="progress-alert" class="col-md-12">
    <div class="alert alert-primary alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <p id="alert-info"></p>
    </div>
</div>
<div id="success-alert" class="col-md-12">
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      下载完成
    </div>
</div>
<div class="col-md-12">
  <button class="btn btn-info" id="massDownload">批量下载作业附件</button>
</div>
<div class="page-header">
  <h3>提交列表</h3>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">团队提交</div>
    <table class="table table-striped">
    	<thead>
       		<th>团队名</th>
        	<th>负责人</th>
        	<th>作业评分</th>
        	<th></th>
     	</thead>
      <tbody>
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
          <td>未评分
          </td>
          @endif
          <td>
            <form action='http://localhost/JWHelper/public/teacher/shomework' method="post">
            <input type="hidden" name="shomeworkID", value="{{ $shomeworkt->shomeworkID}}">
            <button type="submit" class="btn btn-sm btn-info" id="submit-change" >查看</button>
            </form>
          </td>
        </tr>  
       @endforeach
       </tbody>
    </table>
</div>   

<div class="panel panel-primary">
  <div class="panel-heading">个人提交</div>
    <table class="table table-striped">
      <thead>
          <th>学号</th>
          <th>姓名</th>
          <th>作业评分</th>
          <th></th>
      </thead>
      <tbody>
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
            <form action='http://localhost/JWHelper/public/teacher/shomework' method="post">
            <input type="hidden" name="shomeworkID", value="{{ $shomeworkt->shomeworkID}}">
            <button type="submit" class="btn btn-primary" id="submit-change" >查看</button>
            </form>
          </td>
        </tr>  
       @endforeach
    </table>
</div>

@endsection
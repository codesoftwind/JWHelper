@extends('view.template.teacher_layout')

@section('main_panel')

       <!--  <?php 
          // class homework{
          //   var $groupName;
          //   var $leaderName;
          //   var $groupMember;
          //   var $groupID;
          //   var $lessonID;
          //   var $backPage;
          // }

          $homework=array(array('content' =>'2' , 'attachment' =>"baidu",'attachmentName'=>'得到','grade'=>'11','endTime'=>'11','comment' => 'ddasfasf'));
        ?> -->
<div>
<h2>作业详情</h2>
</div>

<table>
  <tr><td>&nbsp</td></tr>

  <tr>
    <th width="100">作业分数</th>
    <td>{{$homework[0]->grade}}</td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
   <tr>
    <th width="100">教师评价</th>
    <td>{{$homework[0]->comment}}</td>
   </tr>
  
  <tr><td>&nbsp</td></tr>
  
   <tr>
    <th width="100">上传作业详情</th>
    <td>{{$homework[0]->content}}</td>
    </td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
  <tr>
    <th width="100">附件下载</th>
    <td>
    <a href="{{ $homework[0]->attachment}}">{{ $homework[0]->attachmentName}}</a></td>
  </tr>
  <tr><td>&nbsp</td></tr>

</table>
  <tr><td>&nbsp</td></tr>
  <tr><td>&nbsp</td></tr>
<table>
<tr>
  <td width="60">
  <a href="http://localhost/JWHelper/public/student/myGroups"><input type="button" class="btn  btn-primary" value="返回"></input></a>
  </td>
</tr>
</table>

@endsection
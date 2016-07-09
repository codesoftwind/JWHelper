@extends('view.template.teacher_layout')

@section('main_panel')

        <?php 
          class homework{
            var $groupName;
            var $leaderName;
            var $groupMember;
            var $groupID;
            var $lessonID;
            var $backPage;
          }

          $homework=new homework();
          $homework->homeworkID='123456';
          $homework->homeworkScore='90';
          $homework->teachercomment='不错';
          $homework->homeworkrequire='要认真';
          $homework->homeworkDetail='666啦啦啦啦啦啦啦啦啦啦啦啦啦啦了啦啦啦啦啦';
          $homework->homeworklink='baidu';

        ?>
<div>
<h2>作业详情</h2>
</div>

<table>
  <tr><td>&nbsp</td></tr>

  <tr>
    <th width="100">作业分数</th>
    <td>{{$homework->homeworkScore}}</td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
   <tr>
    <th width="100">教师评价</th>
    <td>{{$homework->teachercomment}}</td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
   <tr>
    <th width="100">作业要求</th>
    <td>{{$homework->homeworkrequire}}</td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
   <tr>
    <th width="100">上传作业详情</th>
    <td>{{$homework->homeworkDetail}}
    </td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
  <tr>
    <th width="100">附件下载</th>
    <td>
    <a href="{{$homework->homeworklink}}" target="_blank"><input type="button" class="btn  btn-primary" value="点击下载"></input></a>
    </td>
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
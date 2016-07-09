@extends('view.template.teacher_layout')

@section('main_panel')

        <?php 
          class Group{
            var $groupName;
            var $leaderName;
            var $groupMember;
            var $groupID;
            var $lessonID;
            var $backPage;
          }

          $group=new Group();
          $group->groupID='123456';
          $group->groupName='大刀队';
          $group->leaderName='张大彪';
          $group->groupMember=['老王','张嘎子','徐逸','张宝华','聂戴琳','张三','李四','王五','董建华'];
          $group->lessonID='666';
          $group->backPage='accept';

        ?>
<div>
<h2>作业详情</h2>
</div>

<table>
  <tr><td>&nbsp</td></tr>

  <tr>
    <th width="100">作业分数</th>
    <td>{{$group->groupName}}</td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
   <tr>
    <th width="100">教师评价</th>
    <td>{{$group->groupName}}</td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
   <tr>
    <th width="100">作业详情</th>
    <td>{{$group->groupName}}
Bootstrap 提供了下列类型的表单布局：
垂直表单（默认）
内联表单
水平表单
垂直或基本表单
基本的表单结构是 Bootstrap 自带的，个别的表单控件自动接收一些全局样式。下面列出了创建基本表单的步骤：
向父 元素添加 role="form"。
把标签和控件放在一个带有 class .form-group 的  中。这是获取最佳间距所必需的。
向所有的文本元
    </td>
  </tr>
  
  <tr><td>&nbsp</td></tr>
  <tr>
    <th width="100">附件下载</th>
    <td>
    <a href="链接" target="_blank"><input type="button" class="btn  btn-primary" value="点击下载"></input></a>
    </td>
  </tr>
  <tr><td>&nbsp</td></tr>

</table>
  <tr><td>&nbsp</td></tr>
  <tr><td>&nbsp</td></tr>

<table>
<tr>
  <td width="60">
   <form action='http://localhost/JWHelper/public/teacher/backPage', method="post", enctype="multipart/form-data">
      <input type="hidden" name="lessonID", value="{{ $group->lessonID}}">
      <input type="hidden" name="backPage", value="{{ $group->backPage}}">
      <button type="submit" class="btn btn-info" id="submit-change" >返回</button>
    </form>
  </td>
</tr>
</table>

@endsection
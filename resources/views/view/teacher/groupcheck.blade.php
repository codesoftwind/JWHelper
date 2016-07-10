@extends('view.template.teacher_layout')

<?php
$group = $group[0];
?>


@section('headjs')
<script type="text/javascript">
    $(document).ready(function(){$('.judge').hide(); $('.groupID').hide()})

    function submitfunc(obj)
    {
        $.ajax({
            type : "POST" ,
            url : "http://localhost/JWHelper/public/teacher/groupCheck" ,
            dataType : 'json',
            data : { 
              judge : $(obj).prev().prev().val(), 
              groupID : $(obj).prev().val()
                    },  
        success : function(data)
        {
          if (data.status == 1)
          {
            var dialogInstance = new BootstrapDialog();
            dialogInstance.setTitle('操作成功');
            dialogInstance.setMessage(data.descrip);
            dialogInstance.setType(BootstrapDialog.TYPE_SUCCESS);
            dialogInstance.setButtons([{label: '确定', action: function(dialogItself) {dialogItself.close();}}]);
            dialogInstance.open();

            $('#accept').hide();
            $('#deny').hide();
          }
          else
          {
            var dialogInstance = new BootstrapDialog();
            dialogInstance.setTitle('操作失败');
            dialogInstance.setMessage(data.descrip);
            dialogInstance.setType(BootstrapDialog.TYPE_WARNING);
            dialogInstance.setButtons([{label: '确定', action: function(dialogItself) {dialogItself.close();}}]);
            dialogInstance.open();
          }
        }
              });

    }

</script>
@endsection




@section('main_panel')

<div>
<h2 >团队详细信息</h2>
</div>

<table>
  <tr><td>&nbsp;</td></tr>

  <tr>
    <th width="100">团队名称</th>
    <td>{{ $group->groupName }}</td>
  </tr>
  
  <tr><td>&nbsp;</td></tr>

  <tr>
    <th width="100">负责人</th>
    <td>{{ $group->headName }}</td>
  </tr>

  <tr><td>&nbsp;</td></tr>

  <tr>
    <th width="100">团队组员</th>
    <td>
    @foreach ($groupMembers as $member)
    {{ $member->studentID }}-{{ $member->studentName }}&nbsp;&nbsp;
    @endforeach
    </td>
  </tr>

  <tr><td>&nbsp;</td></tr>
</table>

<table align="center">
<tr>
@if($backPage == 'io')
  <td width="70">
      <button class="judge" value=1></button>
      <button class="groupID" value="{{ $group->groupID }}"></button>
      <button class="btn btn-primary" id="accept" onclick="submitfunc(this)">同意</button>
  </td>
  
  <td width="70">
      <button class="judge" value=0></button>
      <button class="groupID" value="{{ $group->groupID }}"></button>
      <button class="btn btn-danger" id="deny" onclick="submitfunc(this)">拒绝</button>
  </td>

  <td width="70">
   <form action='http://localhost/JWHelper/public/teacher/backPage', method="post", enctype="multipart/form-data">
      <input type="hidden" name="backPage", value="{{ $backPage}}">
      <button type="submit" class="btn btn-info" id="back" >返回</button>
    </form>
  </td>
@else
   <td width="70">
   <form action='http://localhost/JWHelper/public/teacher/backPage', method="post", enctype="multipart/form-data">
      <input type="hidden" name="backPage", value="{{ $backPage}}">
      <button type="submit" class="btn btn-info" id="back" >返回</button>
    </form>
  </td>
@endif
</tr>
</table>

@endsection
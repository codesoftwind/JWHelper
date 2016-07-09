@extends('view.template.teacher_layout')

@section('main_panel')

<div>
<h2>团队详细信息</h2>
</div>

<table>
  <tr><td>&nbsp</td></tr>

  <tr>
    <th width="100">团队名称</th>
    <td>{{$group->groupName}}</td>
  </tr>
  
  <tr><td>&nbsp</td></tr>

  <tr>
    <th width="100">负责人</th>
    <td>{{$group->leaderName}}</td>
  </tr>

  <tr><td>&nbsp</td></tr>

  <tr>
    <th width="100">团队组员</th>
    <td>
    @foreach ($group->groupMember as $member)
    {{$member}}&nbsp&nbsp
    @endforeach
    </td>
  </tr>

  <tr><td>&nbsp</td></tr>
</table>

<table align="center">
<tr>
  <td width="60">
    <form action='http://localhost/JWHelper/public/teacher/groupCheck', method="post", enctype="multipart/form-data">
      <input type="hidden" name="status", value="1">
      <button type="submit" class="btn btn-primary" id="submit-change" >同意</button>
    </form>
  </td>
  
  <td width="60">
    <form action='http://localhost/JWHelper/public/teacher/groupCheck', method="post", enctype="multipart/form-data">
      <input type="hidden" name="status", value="0">
      <button type="submit" class="btn btn-danger" id="submit-change" >拒绝</button>
    </form>
  </td>

  <td width="60">
   <form action='http://localhost/JWHelper/public/teacher/backPage', method="post", enctype="multipart/form-data">
      <input type="hidden" name="backPage", value="{{ $group->backPage}}">
      <button type="submit" class="btn btn-info" id="submit-change" >返回</button>
    </form>
  </td>
</tr>
</table>

@endsection
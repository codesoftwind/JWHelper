@extends('view.template.teacher_layout')
@section('main_panel')
<div class="page-header">
  <h1>课程详细信息</h1>
</div>
<div class="well">
  <table >
    <tr>
      <th width="200">课程id</th>
      <th>课程名称</th>
    </tr>
    <?php
    $lesson = $result[0];
    ?>

    <tr>
      <td> 
        {{ $lesson->lessonID }}
      </td>
      <td>
        {{ $lesson->lessonName }}
      </td>
    </tr>

    <tr>
      <th>课程详细信息</th>
    </tr>
    <tr>
      <td>
        {{ $lesson->introduction }}
      </td>
    </tr>
  </table>
</div>
</div>
@endsection
@extends('view.template.admin_layout')

@section('main_panel')
<div class="page-header">
	<h3>教师列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>职工号</th>
    <th>姓名</th>
    <th>详细信息</th>
  </tr>

  			<?php 
  				//$teacher=[["1", "Leo","sdad"], ["2", "Messi","qeweq"]];
  				$teacher = $result;
  				//$lesson['lessonName']ghghg
  			?>

      @foreach ($teacher as $teacher)
<tr> 
      <td>{{  $teacher->teacherID }} </td>

           <td>{{ $teacher->teacherName }}</td>    
           <td>{{ $teacher->basicInfo }}</td>
  </tr>  
       @endforeach



</table>
</div>

@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            $(".nav-sidebar>li").removeClass('active');
            $("#teacherList").addClass('active');
        });
    </script>
@endsection
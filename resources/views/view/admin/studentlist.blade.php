@extends('view.template.admin_layout')

@section('main_panel')
<div class="page-header">
	<h3>学生列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>学号</th>
    <th>姓名</th>
    <th>学院</th>
  </tr>

  			<?php 
  				//$student=[["1", "Leo","软件"], ["2", "Messi","物理"]];
  				$student = $result;
  				//$lesson['lessonName']ghghg
  			?>

      @foreach ($student as $student)
<tr> 
      <td>{{  $student->studentID }} </td>

           <td>{{ $student->studentName }}</td>   
           <td>{{ $student->department }}</td>
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
            $("#studentList").addClass('active');
        });
    </script>
@endsection
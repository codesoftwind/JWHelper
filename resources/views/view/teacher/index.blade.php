@extends('view.template.teacher_layout')

@section('main_panel')
<div class="page-header">
  <h3>课程列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
   		<th>课程名</th>
    	<th></th>
 	</tr>

        <?php 
        
          $lessons = $result;
        ?>

       @foreach ($lessons as $lesson)
           <tr> 
           <td>{{  $lesson->lessonName }}
           </td>
 
<td>
  <div class="btn-group" role="group" aria-label="...">
  <form action='http://localhost/JWHelper/public/teacher/lesson' method="post" enctype="multipart/form-data">
    <input type="hidden" name="lessonID" value="{{ $lesson->lessonID}}">
    <button type="submit" class="btn btn-primary">查看</button>
  </form>
  
</div>
</td>

           </tr>  
       @endforeach



</table>
</div>
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            // 更改sidebar的样式, 使当前页面显示为active
            $("#index").addClass("active");
        });
    </script>
@endsection
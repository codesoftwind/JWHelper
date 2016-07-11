@extends('view.template.admin_layout')

@section('main_panel')
<div class="page-header">
  <h3>课程列表</h3>
</div>
<div class="table-responsive">
<table class="table table-striped">
 <tr>
    <th>课程</th>
    <th>教师</th>
  </tr>

        <?php 
          $lessons = $result;
        ?>

       @foreach ($lessons as $lesson)
           <tr> <td>{{  $lesson->lessonName }}
           </td>

           <td>{{  $lesson->teacherName }}</td>
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
            $("#index").addClass('active');
        });
    </script>
@endsection

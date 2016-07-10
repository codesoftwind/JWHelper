@extends('view.template.layout')

@section('sidebar')
    <ul class="nav nav-sidebar">
      <li id="index" class="active"><a href="http://localhost/JWHelper/public/admin/semester_info"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> 课程列表</a></li>
      <li id="importCourse"><a href="http://localhost/JWHelper/public/admin/uploadLessonPage"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> 导入课程</a></li>
      <li id="importSelect"><a href="http://localhost/JWHelper/public/admin/uploadChoosePage"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> 导入选课表</a></li>
      <li id="importTeach"><a href="http://localhost/JWHelper/public/admin/uploadTeachPage"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> 导入授课表</a></li>
      <li id="semesterInfo"><a href="http://localhost/JWHelper/public/admin/semester_info"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> 学期信息设置</a></li>
    </ul>
    <ul class="nav nav-sidebar">
      <li id="teacherList"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 教师列表</a></li>
      <li id="studentList"><a href="http://localhost/JWHelper/public/template/no-page"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 学生列表</a></li>
      <li id="importTeacher"><a href="http://localhost/JWHelper/public/admin/uploadTeacherPage"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> 导入教师信息</a></li>
      <li id="importStudent"><a href="http://localhost/JWHelper/public/admin/uploadStudentPage"><span class="glyphicon glyphicon-import" aria-hidden="true"></span> 导入学生信息</a></li>
    </ul>
@endsection
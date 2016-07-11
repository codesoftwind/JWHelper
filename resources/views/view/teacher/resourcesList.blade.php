@extends('view.template.teacher_layout')

@section('headjs')
<script type="text/javascript">
    $(document).ready(function () {
        //$('#hospital').addClass('active');
        var file_name = ""
        $('#f-success-alert').hide()
        $('#f-fail-alert').hide()
        $('#c-success-alert').hide()
        $('#c-fail-alert').hide()
        $('#f-progress-alert').hide()
        $('#submit-form').click(function(){
            $("#f-progress-alert").fadeIn()
            setTimeout(function(){
                $("#f-progress-alert").fadeOut()
                $("#f-success-alert").fadeIn()
                setTimeout(function(){
                    $("#uploadForm").submit()
                },2000)
            },3000)            
            // $.ajax({
            //     type : 'POST',
            //     url: "http://localhost/JWHelper/public/teacher/resourceUpload",
            //     dataType : 'json',
            //     data : {
            //         resourceName : $('#resourceName').val(),
            //         resourceInfo : $('#resourceInfo').val(),
            //         resourceCategory : $('#resourceCategory').val(),
            //         resourceFile : file_name
            //     },
            //     success: function(data){                    
            //         $('#f-progress-alert').fadeOut()
            //         if (data.status == 1){
            //             $('#f-success-alert').fadeIn()
            //             setTimeout(function(){
            //                 window.location.href = "http://localhost/JWHelper/public/teacher/resourcesList"
            //             },2000)
            //         }
            //         else
            //             $('#f-fail-alert').fadeIn()
            //     }
            // });
        });
        $('#submit-class').click(function(){
            $.ajax({
                type : "POST" ,
                url : "http://localhost/JWHelper/public/teacher/resourcesClassify" ,
                dataType : 'json',
                data : {
                    categoryName : $('#newClassName').val()
                },  
                success : function(data){
                    if (data.status == 1){
                        $('#c-success-alert').fadeIn()
                        setTimeout(function(){
                            window.location.href = "http://localhost/JWHelper/public/teacher/resourcesList"
                        },2000)
                    }
                    else
                        $('#c-fail-alert').fadeIn()
                }
            });
        });
    });
</script>
@endsection

@section('main_panel')
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="select_data">
        @if(isset($data))
            @foreach($data as $datum)
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="heading{{ $datum['category'] }}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapse{{ $datum['category'] }}" aria-expanded="true"
                               aria-controls="collapse{{ $datum['category'] }}">
                                {{ $datum['category'] }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $datum['category'] }}" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="heading{{ $datum['category'] }}">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>资源</th>
                                    <th>描述</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datum['items'] as $item)
                                    <tr>
                                        <td><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></td>
                                        <td>{{ $item['info'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="col-md-1 col-sm-2">
    <button align="right" class="btn btn-success btn-md" data-toggle="modal" data-target="#upload-modal">上传资源</button>
</div>
<div class="col-md-1 col-sm-2">
    <button align="right" class="btn btn-warning btn-md" data-toggle="modal" data-target="#newClass-modal">新建分类</button>
</div>

<!-- Resource Upload -->
<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">上传资源</h4>
      </div>
      <div class="modal-body">
        <div id="f-progress-alert" class="col-md-12">
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              上传中……
            </div>
        </div>
        <div id="f-success-alert" class="col-md-12">
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              上传成功
            </div>
        </div>
        <div id="f-fail-alert" class="col-md-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              上传失败
            </div>
        </div>
        <form id="uploadForm" action="http://localhost/JWHelper/public/teacher/resourceUpload" method="POST" enctype="multipart/form-data">
            <label for="resourceName">资源名称</label>
            <input class="form-control" id="resourceName" name="resourceName"/>
            <label for="resourceInfo">资源描述</label>
            <input class="form-control" id="resourceInfo" name="resourceInfo"/>
            <label for="resourceCategory">资源分类</label>
            <select class="form-control" id="resourceCategory" name="resourceCategory"/>
                @if(isset($categories))
                @foreach($categories as $category)
                <option value="{{ $category->catogoryID }}">{{ $category->catogoryName }}</option>
                @endforeach
                @endif
            </select>
            <label for="resourceFile">选择文件</label>
            <input class="form-control" type="file" id="resourceFile" name="resourceFile" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
        <button type="button" id="submit-form" class="btn btn-success">提交</button>
      </div>
    </div>
  </div>
</div>

<!-- New Class -->
<div class="modal fade" id="newClass-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">新建分类</h4>
      </div>
      <div class="modal-body">
        <div id="c-success-alert" class="col-md-12">
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              提交成功
            </div>
        </div>
        <div id="c-fail-alert" class="col-md-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              提交失败
            </div>
        </div>
        <label for="resourceName">新建分类名称</label>
        <input class="form-control" id="newClassName"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
        <button type="button" id="submit-class" class="btn btn-success">确定</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('bodyJS')
    @parent
    <script>
        $(function () {
            // 更改sidebar的样式, 使当前页面显示为active
            $("#resource").addClass("active");
        });
    </script>
@endsection
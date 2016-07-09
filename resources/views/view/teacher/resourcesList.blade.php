@extends('view.template.teacher_layout')

@section('headjs')
<script type="text/javascript">
    $(document).ready(function () {
        //$('#hospital').addClass('active');
        $('#success-alert').hide()
        $('#fail-alert').hide()
        $('#progress-alert').hide()
        $('#submit-change').click(function(){
            $('#uploadForm').submitForm({
                url: "http://localhost/JWHelper/public/teacher/resourceUpload",
                dataType: "json",
                callback: function(data){
                    $('#progress-alert').fadeOut()
                    endFileUpload();
                    if (data.status == 1){
                        $('#success-alert').fadeIn()
                        setTimeout(function(){
                            window.location.href = "http://localhost/JWHelper/public/teacher/resourcesList"
                        },2000)
                    }
                    else
                        $('#fail-alert').fadeIn()
                },
                before: function(){
                    $('#progress-alert').fadeIn()
                    startFileUpload();
                }
            }).submit();
        });
    });
</script>
@endsection

@section('main_panel')
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="select_data">
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
    </div>
</div>

<button align="right" class="btn btn-success btn-md" data-toggle="modal" data-target="#modify-modal">上传资源</button>
<div class="modal fade" id="modify-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">上传资源</h4>
      </div>
      <div class="modal-body">
        <div id="progress-alert" class="col-md-12">
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              上传中……
            </div>
        </div>
        <div id="success-alert" class="col-md-12">
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              上传成功
            </div>
        </div>
        <div id="fail-alert" class="col-md-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              上传失败
            </div>
        </div>
        <form id="uploadForm">
            <label for="resourceName">资源名称</label>
            <input class="form-control" id="resourceName"/>
            <label for="resourceInfo">资源描述</label>
            <input class="form-control" id="resourceInfo"/>
            <label for="resourceCategory">资源分类</label>
            <select class="form-control" id="resourceCategory"/>
                <option value="未分类">未分类</option>
                @foreach($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
            <label for="resourceFile">选择文件</label>
            <input class="form-control" type="file" id="resourceFile" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
        <button type="button" id="submit-change" class="btn btn-success">上传</button>
      </div>
    </div>
  </div>
</div>
@endsection
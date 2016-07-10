<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JW Helper</title>
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="{{asset('css/bootstrap-3.3.6.min.css')}}">

	<!-- Optional theme -->
	<link rel="stylesheet" href="{{asset('css/bootstrap-theme-3.3.6.min.css')}}">

	<!-- Latest compiled and minified JavaScript -->
	<script src="{{asset('js/bootstrap.min.js')}}"></script>

	<!-- Bootstrap Dialog -->
	<link rel="stylesheet" href="{{asset('css/bootstrap-dialog.min.css')}}">
	
	<script src="{{asset('js/bootstrap-dialog.min.js')}}"></script>

	<link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
</head>
<body>
	<div class="container">
		<div class="card card-container">
			<h3>北航教务系统</h3>
			<img src="{{asset('images/avatar_2x.png')}}" alt="" id="profile-img" class="profile-img-card">
			<p id="profile-name" class="profile-name-card"></p>
			<form class="form-signin">
				<span id="reauth-username" class="reauth-username"></span>
				<input type="text" name="username" id="inputUsername" class="form-control" placeholder="用户名" required autofocus title="请填写用户名">
				<input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码" required title="请填写密码">

				<button id="submit" class="btn btn-lg btn-primary btn-block btn-signin" type="button">登录</button>
			</form>
		</div><!-- /card-container -->
	</div><!-- container -->
	<script>
		$(function() {
			var basicURL = "http://localhost/JWHelper/public/";

			// 回车键提交表单
			$('input').keydown(function(e) {
				if (e.keyCode == 13) {
					$("#submit").click();
				}
			});

			$("#submit").click(function() {
				var username = $("#inputUsername").val();
				var password = $("#inputPassword").val();
				var data = {'userID': username, 'password': password};

				var url = basicURL + "authLogin";

				//To do. 处理不同的登录结果
				function successHandler(data) {
					console.log(data);

					var dialogInstance = new BootstrapDialog();
					// 登录失败，用户名或密码错误
					if (data['status'] == 0) {
						dialogInstance.setTitle('用户名或者密码错误');
						dialogInstance.setMessage('请重新输入正确的用户名和密码');
						dialogInstance.setType(BootstrapDialog.TYPE_WARNING);
						dialogInstance.setButtons([{label: '好的', action: function(dialogItself) {dialogItself.close();}}]);
						dialogInstance.open();

					} else { // 登录成功
						var redirectURL = basicURL + data['role'] + '/index';
						function redirect() {
							window.location.href = redirectURL;
						}
						var redirectTimeout = window.setTimeout(redirect, 2000);
						var changeMessageTimeout = window.setTimeout(changeMessage, 1000);

						dialogInstance.setTitle('登录成功');
						dialogInstance.setMessage('2秒后将跳转到主界面');
						dialogInstance.setType(BootstrapDialog.TYPE_SUCCESS);
						dialogInstance.setButtons([
							{
								label: '立即跳转',
								action: function(dialogItself) {
									dialogItself.close();
									window.clearTimeout(redirectTimeout);
									window.clearTimeout(changeMessageTimeout);
									window.location.href = redirectURL;
								}
							}
						]);
						dialogInstance.open();

						function changeMessage() {
							dialogInstance.setMessage('1秒后将跳转到主界面');
						}


					}
				}

				$.ajax({
					type: "POST",
					url: url,
					data: data,
					success: successHandler,
					error: function (jqXHR, exception) {
						var msg = '';
						if (jqXHR.status === 0) {
							msg = 'Not connect.\n Verify Network.';
						} else if (jqXHR.status == 404) {
							msg = 'Requested page not found. [404]';
						} else if (jqXHR.status == 500) {
							msg = 'Internal Server Error [500].';
						} else if (exception === 'parsererror') {
							msg = 'Requested JSON parse failed.';
						} else if (exception === 'timeout') {
							msg = 'Time out error.';
						} else if (exception === 'abort') {
							msg = 'Ajax request aborted.';
						} else {
							msg = 'Uncaught Error.\n' + jqXHR.responseText;
						}
						BootstrapDialog.show({
							title: '网络连接错误',
							message: msg,
							type: BootstrapDialog.TYPE_DANGER,
							buttons: [
								{
									label: '关闭',
									action: function(dialogItself) {
										dialogItself.close();
									}
								}
							]
						});
					},
					dataType: "json"
				});
			});
		});
	</script>
</body>
</html>
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
			<img src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="" id="profile-img" class="profile-img-card">
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

			$("#submit").click(function() {
				var username = $("#inputUsername").val();
				var password = $("#inputPassword").val();
				var data = {'userID': username, 'password': password};
				console.log(data);

				var url = basicURL + "authLogin";

				//To do. 处理不同的登录结果
				function successHandler(data) {
					// 登录失败，用户名或密码错误
					if (data['status'] == 0) {
						BootstrapDialog.show({
							type: BootstrapDialog.TYPE_WARNING,
							title: '用户名或者密码错误',
							message: '请重新输入正确的用户名和密码',
							buttons: [
								{
									label: '好的',
									action: function(dialogItself){
                    					dialogItself.close();
                					}
								}
							]
						});
					} else { // 登录成功
						var url = basicURL + data['role'] + '/index';
						function redirect() {
							window.location.href = url;
						}
						var timeoutID = window.setTimeout(redirect, 2000);
						BootstrapDialog.show({
							type: BootstrapDialog.TYPE_SUCCESS,
							title: '登录成功',
							message: '两秒后将跳转到主界面',
							buttons : [
								{
									label: '立即跳转',
									action: function(dialogItself) {
										dialogItself.close();
										window.clearTimeout(timeoutID);
										window.location.href = url;
									}
								}
							]
						});

					}
				}

				$.ajax({
					type: "POST",
					url: url,
					data: data,
					success: successHandler,
					dataType: "json"
				});
			});
		});
	</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JW Helper</title>
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<!-- Bootstrap Dialog -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>

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
					if (data['status'] == 0) {
						BootstrapDialog.alert('Hello');
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
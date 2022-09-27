<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link rel="icon" href="/application/favicon.ico">
	<title>Войдите</title>

	<script src="/application/js/jquery-1.9.1.js"></script>
	<script src="/application/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/application/css/bootstrap.min.css">
</head>
<style>
	#background {
		background-image: url(application/img/medved-login.gif);
		background-repeat: no-repeat;
		background-size: contain;
		background-position: top left;
		height: 70vh;
	}

	#pad	{
		margin: 27vh auto;
		width: 380px;
		position: relative;
		opacity: 0.9;
	}
	form {
		border: solid 60px #f5eeeb;
		position: absolute;
		bottom: -100px;
		padding: 40px;
	}
</style>

<body>
<div id="background">
	<div id="pad">
		<form method="post" action="/login" class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-10">
					<input type="text" class="form-control" name="user" placeholder="Имя">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
					<input type="password" class="form-control" name="password" placeholder="Пароль">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-success" style="width: 100%;">Войдите</button>
				</div>
			</div>
		</form>
	</div>
</div>


</body>

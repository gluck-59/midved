<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link rel="icon" href="/application/favicon.ico">

	<script src="/application/js/jquery-1.9.1.js"></script>
	<script src="/application/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/application/css/bootstrap.min.css">
</head>

<body>
	<div style="margin: 30vh auto; width: 200px;">
		<form method="post" action="/" class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-10">
					<input type="text" class="form-control" name="user" placeholder="User">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-success">Sign in</button>
				</div>
			</div>
		</form>
	</div>
</body>

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
	#root {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<body>
<div id="root">
    <div class="row">
        <div class="col-xs-12">
            <?php echo (isset($_GET['wrongpassword']) ? '<div class="has-error">Неверный пароль</div>' : ''); ?>
            <form method="post" action="/login" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="text" class="form-control" name="user" placeholder="Имя" value="demo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" class="form-control" name="password" placeholder="Пароль" value="demo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success" style="width: 100%;">Войдите</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</center>
</body>

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

    <title>Войдите</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f0f0f0;
        }
        .outer {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 800px;
            aspect-ratio: 21 / 9;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin: 2rem;
            box-sizing: border-box;
            background: #fff;
        }
        .inner {
            display: flex;
            width: 100%;
            /*height: 100%;*/
            gap: 2rem;
        }
        .half {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex: 1;
            /*border: 1px solid #0074D9;*/
            box-sizing: border-box;
        }
        .half:last-child {
            /*border: dotted 1px #2ECC40;*/
            /*border-left: none;*/
        }
        .half img {
            object-fit: cover;
            width: 100%;
        }
        @media (max-width: 600px) {
            .inner {
                flex-direction: column;
                height: auto;
            }
            .half {
                width: 100%;
                /*height: 50%;*/
            }
        }
    </style>
</head>
<body>
<div class="outer">
    <div class="inner">
        <div class="half">
            <div class="row">
                <div class="col-xs-12">
                    <center><h4>Навырост CRM</h4></center>
                    <ul>
                        <li class="text-muted">Планируйте работу с клиентами</li>
                        <li class="text-muted">Планируйте свое расписание</li>
                        <li class="text-muted">Фиксируйте приходы и расходы</li>
                        <li class="text-muted">Отслеживайте дебиторку</li>
                    </ul>
                </div>
            </div>

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
                                <button type="submit" class="btn btn-success" style="width: 100%;">Войти</button>
                            </div>
                        </div>
                        <small class="text-muted"><a href="https://t.me/navcrm" target="_blank">Связаться с разработчиками</a></small>
                    </form>
                </div>
            </div>
        </div>
        <div class="half">
            <img src="application/img/logo.jpg" style="">
        </div>
    </div>
</div>
</body>
</html>

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
                <div hidden class="guide">
                    <div class="row">
                        <div class="col-xs-12">
                            <center><h4>Инструкция</h4></center>
                            <ul>
                                <li class="text-muted">Для создания своего рабочего пространства <a href="https://t.me/navcrm" target="_blank">свяжитесь с разработчиками</a></li>
                                <li class="text-muted">Войдите</li>
                                <li class="text-muted">Создайте Клиента</li>
                                <li class="text-muted">Создайте его Оборудование</li>
                                <li class="text-muted">Создайте Заявку например на ремонт этого Оборудования</li>
                                <li class="text-muted">Внутри Заявки добавьте доходы-расходы по ней</li>
                                <li class="text-muted">Снимите предложенные демо-отчеты</li>
                            </ul>
                            <center><div class="btn btn-success toggle">OK</div></center>
                        </div>
                    </div>
                </div>
                <div class="row loginform">
                    <div class="col-xs-12">
                        <center><h4>Навырост CRM</h4></center>
                        <ul>
                            <li class="text-muted">Планируйте работу с клиентами</li>
                            <li class="text-muted">Фиксируйте приходы и расходы</li>
                            <li class="text-muted">Отслеживайте дебиторку</li>
                            <li class="text-muted"><a href="#" class="toggle">Инструкция</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row loginform">
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

        <div class="inner1">
            <div class="1row">
                <div class="col-xs-12">
                    <a href="#" class="togglePolicy">Политика конфиденциальности</a>
                    <div hidden class="policy">
                        <h4>Уведомление о cookie и сборе (обработке) персональных данных</h4>
                        <div class="text-muted">
                            <p>Администрация сайта информирует, что при использовании данного сайта не осуществляется сбор, хранение и обработка персональных данных пользователей.</p>
                            <p>Техническая информация (например cookie) используется в обезличенной форме в целях обеспечения работы сайта. Продолжая использовать данный сайт, Вы соглашаетесь с использованием cookie.</p>
                            <p>В случае изменения политики в отношении персональных данных данное уведомление будет обновлено и пользователи будут своевременно информированы.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
<script>
    $('.toggle').on('click', function (event) {
        $('.guide').toggle();
        $('.loginform').toggle();
    })

    $('.togglePolicy').on('click', function (event) {
        $('.policy').toggle();
    })
</script>
</body>
</html>

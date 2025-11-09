<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//prettyDump($this->router->class);
?>
<!DOCTYPE html>
<html lang="ru">
<?php $docTitle = isset($pageTitle) ? $pageTitle : $this->router->pageName; ?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<link rel="icon" href="/application/favicon.ico">
	<title><?=$docTitle?></title>
	<link rel="stylesheet" href="/application/css/bootstrap.min.css">
	<link rel="stylesheet" href="/application/css/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="/application/css/style.css">
</head>
<body onload="footerFill()">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<a class="navbar-brand" href="/"><img id="logo" src="/application/img/logo-medved.png" style="margin: -13px;"></a>
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?=$this->router->pageName?></a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="<?=($this->router->class == $this->router->default_controller ? 'active':'' )?>"><a href="/"><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;Главная</a></li>
					<li class="<?=($this->router->class == 'request' ? 'active':'' )?>"><a href="/request"><i class="glyphicon glyphicon-list"></i>&nbsp;&nbsp;Заявки</a></li>
					<li class="<?=($this->router->class == 'equipment' ? 'active':'' )?>"><a href="/equipment"><i class="glyphicon glyphicon-hdd"></i>&nbsp;&nbsp;Обрудование</a></li>
					<li class="<?=($this->router->class == 'customer' ? 'active':'' )?>"><a href="/customer"><i class="glyphicon glyphicon-object-align-bottom"></i>&nbsp;&nbsp;Клиенты</a></li>
					<li class="<?=($this->router->class == 'report' ? 'active':'' )?>"><a href="/report"><i class="glyphicon glyphicon-ruble"></i>&nbsp;&nbsp;Отчеты</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

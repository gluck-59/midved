<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/application/favicon.ico">
<!--	<link rel="canonical" href="https://getbootstrap.com/docs/3.3/examples/starter-template/">-->

	<title>Starter</title>

	<link rel="stylesheet" href="/application/css/bootstrap.min.css">
	<link rel="stylesheet" href="/application/css/style.css">
	<link rel="stylesheet" href="/application/css/bootstrap-select/bootstrap-select.min.css">
</head>

<body>



<nav class="navbar navbar-inverse navbar-fixed-top">
	<a class="navbar-brand" href="#"><img id="logo" src="/application/img/logo.png"></a>
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Туда-Обратно</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="/">Главная</a></li>
				<li><a href="/request">Заявки</a></li>
				<li><a href="/equipment">Обрудование</a></li>
				<li><a href="/customer">Клиенты</a></li>
				<li><a href="/payment">Расчеты</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>

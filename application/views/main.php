<?php
//prettyDump($customers[0]);
//prettyDump($equipments[0]);
//prettyDump($requests[0]);
//prettyDump($toastr);

?>


<div class="container-fluid">
	<h3>Главная <small class="text-muted">страница</small></h3>
	<div class="row">
		<div class="col-xs-12 col-lg-4">
			<p class="text-muted">На главной собраны функции, которые вы используете чаще всего. Главную можно конфигурять вдоль и поперек, ограничение только логикой и размером экрана.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-lg-3">
			<div class="btn-block">
				<button type="button" class="btn btn-success btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-request">Новая заявка</button>
				<button type="button" class="btn btn-warning btn-lg btn-block btn-open-modal"  data-toggle="modal" data-request-id="" data-direction="1" data-target="#modalPrihodRashod">Новый приход</button>
				<button type="button" class="btn btn-danger btn-lg btn-block btn-open-modal"  data-toggle="modal" data-request-id="" data-direction="0" data-target="#modalPrihodRashod">Новый расход</button>
				<a href="https://calendar.google.com/calendar/u/0/r" target="_blank" type="button" class="btn btn-info btn-lg btn-block">Расписание</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-lg-4">
			<h3>Сводка <small class="text-muted">на неделю</small></h3>
			<p class="text-muted">Сюда можно поставить предстоящие в следующие дни события — в какие города ехать что делать. Теоретически можно интегрироваться с гуглокалендарем и тянуть оттуда данные.</p>
		</div>
	</div>
</div>


<?php
//prettyDump($equipments);
?>


<nav class="navbar navbar-inverse navbar-fixed-top">
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

<div class="container-fluid">
	<div class="starter-template">
		<div class="row">
			<div class="col-md-2"
				<div class="btn-block">
					<button type="button" class="btn btn-success btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-request">Новая заявка</button>
					<button type="button" class="btn btn-info btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-payment">Новый платеж</button>
					<a href="https://calendar.google.com/calendar" target="_blank" type="button" class="btn btn-warning btn-lg btn-block">Расписние</a>
				</div>
			</div>
		</div>
	<h4>Главная <small class="text-muted">страница</small></h4>
	<p class="text-muted">На главной собраны функции, которые ты делаешь чаще всего. Можно конфигурять вдоль и поперек, ограничение только размером экрана.</p>
	</div>
</div>

<!---------------------------------------------->

<!-- Modal request -->
<div class="modal fade" id="modal-request" tabindex="-1" role="dialog" aria-labelledby="requestLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="requestLabel">Заявка</h4>
			</div>
			<div class="modal-body">
				<select class="selectpicker" id="customer" data-live-search="true" title="Выберите клиента...">
					<?php
						foreach ($customers as $customer) { ?>
							<option value="<?=$customer->id?>" data-subtext="<?=$customer->address?>"><?=$customer->name?></option>
						<?php } ?>
				</select>

				<div class="clearfix">&nbsp;</div>

				<select class="selectpicker" id="equipment" data-live-search="true" title="Выберите станок...">
					<?php
						foreach ($equipments as $equipment) { ?>
					<option value="<?=$equipment->id?>" data-subtext="<?=$equipment->equipment_name?>&nbsp;<?=$equipment->equipment_mark?> <?=$equipment->mark?>""><?=$equipment->customer_name?></option>
					<?php } ?>
				</select>

				<div class="clearfix">&nbsp;</div>

				<input type="text" class="form-control" placeholder="Описание заявки">
				<div class="clearfix">&nbsp;</div>

				<p>Выбираешь клиента и станок. Забиваешь новую заявку.</p>
				<p>Связь "клиент-станок" пока не прописана. Заявка не сохраняется. Не ссать, это демо.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success">OK</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal payment -->
<div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="paymentLabel">Платеж</h4>
			</div>
			<div class="modal-body">
				<select class="selectpicker" data-live-search="true" title="Выберите заявку...">
					<?php
						foreach ($requests as $request) { ?>
							<option value="<?=$request->id?>" data-subtext="<?=$request->equipment?>&nbsp;<?=$request->mark?> — <?=$request->customer?>"><?=$request->name?></option>
						<?php } ?>
				</select>
				<div class="clearfix">&nbsp;</div>
				<input type="number" class="form-control" placeholder="Сумма">
				<div class="clearfix">&nbsp;</div>

				<p>Заявка, в которую нужно добавить платеж</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success">OK</button>
			</div>
		</div>
	</div>
</div>

<?php
	prettyDump($request);
	$status = 'Новая';
	($request->status == 1 ? $status = 'В работе' : $status = 'Выполнена');
	$sumStatus = 'label label-danger';
	($request->sum > 0 ? $sumStatus = 'label label-success' : '')

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<h3>Заявка №<?=$request->id?>&nbsp;<small class="label label-default"><?=$status?></small>&nbsp;<small class="<?=$sumStatus?>"><?=round($request->sum, 2)?> ₽</small></h3>
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<div class="col-md-9 col-lg-6 col-sm-12">
					<div class="col-md-6 items_container">
						<div class="items_head">Заказчик</div>
						<div class="items_value">
						<?=$request->customer_name?>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-lg-6 col-sm-12">
					<div class="col-md-6 items_container">
						<div class="items_head">Оборудование</div>
						<div class="items_value">
						<?=$request->equipment_name?> <?=$request->mark?>
							<div id="equipmentDetails" role="presentation" class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
									Подробно
									<span class="caret"></span>
								</a>
								<div class="dropdown-menu" aria-labelledby="" style="width: 894px; padding: 0px;">
									<div class='items_value' style="opacity: 0.6">
										<table id="equipmentDetailsData" class="sub_list table 1table-responsive table-striped table-condensed table-bordered">
											<thead>
												<tr>
													<th>Голова</th>
													<th style="width: 10px;">Ноги</th>
													<th>Жопа</th>
													<th>Серийник</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-lg-6 col-sm-12">
					<div class="col-md-6 items_container">
						<div class="items_head">Работы</div>
						<div class="items_value">
						<?=$request->name?>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-lg-6 col-sm-12">
					<div class="col-md-6 items_container">
						<div class="items_head">Расчеты</div>
						<div class="items_value">
							<div id="paymentsHistory" role="presentation" class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
									История
									<span class="caret"></span>
								</a>
								<div class="dropdown-menu" aria-labelledby="" style="width: 894px; padding: 0px;">
									<div class='items_value' style="opacity: 0.6">
										<table id="paymentsHistoryData" class="sub_list table 1table-responsive table-striped table-condensed table-bordered">
											<thead>
												<tr>
													<th>Дата</th>
													<th style="width: 10px;">Сумма</th>
													<th>Статья</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						Чото тут если надо
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
//	prettyDump($request);
//	prettyDump($payments);
	$status = 'Новая';
	($request->status == 1 ? $status = 'В работе' : $status = 'Выполнена');
	$sumStatus = 'label label-danger';
	($request->sum > 0 ? $sumStatus = 'label label-success' : '');

	// платежи
	$prihod = 0.0;
	$rashod = 0.0;
	$tableHtml = '';
	$tableHtmlSpanClass = 'label label-default';
	$paymentType = 'Накладные';
	foreach ($payments as $payment) {
		if ($payment->sum < 0) {
			$rashod += abs($payment->sum);
			$tableHtmlSpanClass = 'label label-danger';
		}
		else {
			$prihod += $payment->sum;
			$tableHtmlSpanClass = 'label label-success';
		}

		if ($payment->type) $paymentType = 'Работы';

		$tableHtml .= '<tr>
			<td>'.$payment->created.'</td>
			<td><span class="'.$tableHtmlSpanClass.'">'.round($payment->sum, 2).' ₽</span></td>
			<td>'.$paymentType.'</td>
		</tr>';


}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<h3><a href="/request"><span class="label label-info"><i class="glyphicon glyphicon-arrow-left"></i></span></a>
				Заявка №<?=$request->id?>&nbsp;<small class="label label-default hidden-xs"><?=$status?></small>&nbsp;<small class="hidden-xs">баланс</small>&nbsp;<small class="<?=$sumStatus?>"><?=round($request->sum, 2)?>&nbsp;₽</small></h3>
			<span class="text-muted">создано</span> <?=$request->created?> <span class="text-muted">обновлено</span> <?=$request->updated?>
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<div class="col-md-9 col-lg-6 col-sm-12">
					<div class="col-md-6 items_container">
						<div class="items_head">Работы</div>
						<div class="items_value">
							<?=$request->name?>
						</div>
						<a href="https://www.google.ru/maps/place/<?=$request->city.' '.$request->address?>" target="_blank"><?=$request->city . ' ' . $request->address?> </a>
					</div>
				</div>

				<div class="col-md-9 col-lg-6 col-sm-12">
					<div class="col-md-6 items_container">
						<div class="items_head">Оборудование</div>
						<div class="items_value">
						<?=$request->equipment?> <?=$request->mark?>
							<div id="equipmentDetails" role="presentation" class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
									Подробно
									<span class="caret"></span>
								</a>
								<div class="dropdown-menu" aria-labelledby="" style="width: 30em; max-width: 80vw; padding: 5px;">
									<div class='items_value' style="opacity: 0.6">
										<table id="equipmentDetailsData" class="table table-responsive table-striped table-condensed table-border">
											<thead>
												<tr>
													<th>Голова</th>
													<th>Ноги</th>
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
						<div class="items_head">Заказчик</div>
						<div class="items_value">
							<?=$request->customer_name?>
						</div>
					</div>
				</div>



				<div class="1col-md-9 1col-lg-9 col-sm-12">
					<div class="col-md-6 items_container">
<!--						<div class="items_head">Расчеты</div>-->
						<center class="items_value">
							<h3>
<!--								<span class="label label-info">--><?//=$rashod?><!-- ₽</span> <span class="label label-info">--><?//=$prihod?><!-- ₽</span>-->
								<span style="color: #3e8f3e"><?=$rashod?></span><span class="small">₽</span>&nbsp;&nbsp;<span style="color: #761c19"><?=$prihod?></span><span class="small">₽</span>
							</h3>
							<div class="clearfix">&nbsp;</div>
							<div class="label label-danger paymentEdit" data-toggle="modal" data-target="#modal-prihod_rashod" data-modal-name="Накладные: расход" data-type="0" data-direction="0" style="padding: 10px 10px">– Накладные</div>
							<div class="label label-danger paymentEdit" data-toggle="modal" data-target="#modal-prihod_rashod" data-modal-name="Работа: расход" data-type="1" data-direction="0" data-modal-name="Работа" style="padding: 10px 10px">– Работа</div>
							<div class="label label-success paymentEdit" data-toggle="modal" data-target="#modal-prihod_rashod" data-modal-name="Работа: приход" data-type="1" data-direction="1" data-modal-name="Работа" style="padding: 10px 10px">+ Работа</div>
							<div class="label label-success paymentEdit" data-toggle="modal" data-target="#modal-prihod_rashod" data-modal-name="Накладные: приход" data-type="0" data-direction="1" data-modal-name="Накладные" style="padding: 10px 10px">+ Накладные</div>
						</center>
					</div>
				</div>

				<div class="clearfix">&nbsp;</div><div class="clearfix"><hr></div>

				<div class="col-md-9 col-lg-6 col-sm-12">
					<div class="col-md-6 items_container">
						<div class="items_head">История</div>
						<div class="items_value">
							<table id="paymentsHistoryData" class="table table-responsive table-striped table-condensed table-border">
								<thead>
								<tr>
									<th>Дата</th>
									<th>Сумма</th>
									<th>Статья</th>
								</tr>
								</thead>
								<tbody><?=$tableHtml?></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

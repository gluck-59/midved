<?php
//	prettyDump($request);
//	prettyDump($payments);
	switch($request->status) {
		case 0: $status = 'Новая';break;
		case 1: $status = 'В работе';break;
		case 2: $status = 'Готово';break;
	}

	$sumStatus = 'label label-danger';
	($request->sum > 0 ? $sumStatus = 'label label-success' : '');

	// платежи
	$currency = new NumberFormatter( 'ru_RU', NumberFormatter::DECIMAL );
	$currency->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

	$prihod = 0.0;
	$rashod = 0.0;
	$tableHtml = '';
	$tableHtmlSpanClass = 'label label-default';

	foreach ($payments as $payment) {
		if ($payment->sum < 0) {
			$rashod += abs($payment->sum);
			$tableHtmlSpanClass = 'label label-danger';
		}
		else {
			$prihod += $payment->sum;
			$tableHtmlSpanClass = 'label label-success';
		}


		switch ($payment->type) {
			case 0: $paymentType = 'Работа'; break;
			case 1: $paymentType = 'Накладные'; break;
		}

		$tableHtml .= '<tr>
			<td>'.$payment->created.'</td>
			<td><span class="'.$tableHtmlSpanClass.'">'.$currency->format($payment->sum).' ₽</span></td>
			<td>'.$paymentType.'</td>
			<td><button type="button" class="close deletePayment" id="'.$payment->id.'"><i class="glyphicon glyphicon-remove"></i></button></td>
		</tr>';

	}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<h3><a href="/request"><span class="label label-info"><i class="glyphicon glyphicon-arrow-left"></i></span></a>
				Заявка №<?=$request->id?>&nbsp;<small class="label label-default hidden-xs"><?=$status?></small>&nbsp;<small class="hidden-xs">баланс</small>&nbsp;<small class="<?=$sumStatus?>"><?=$currency->format($request->sum)?>&nbsp;₽</small></h3>
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
								<span style="color: #761c19"><?=$currency->format($rashod)?> ₽</span><span class="small"></span>&nbsp;&nbsp;<span style="color: #3e8f3e"><?=$currency->format($prihod)?> ₽</span><span class="small"></span>
							</h3>
							<div class="row">
								<div class="col-xs-6 text-right">
									<div class="btn btn-danger paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Работа: расход" data-type="1" data-direction="0" data-modal-name="Работа" >Work</div>
									<div class="btn btn-success paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Работа: приход" data-type="1" data-direction="1" data-modal-name="Работа" >Work</div>
								</div>

								<div class="col-xs-6 text-left">
									<div class="btn btn-danger paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Накладные: расход" data-type="0" data-direction="0" >Extra</div>
									<div class="btn btn-success paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Накладные: приход" data-type="0" data-direction="1" data-modal-name="Накладные" >Extra</div>
								</div>
							</div>
						</center>
					</div>
				</div>

				<div class="clearfix hidden-xs">&nbsp;</div><div class="clearfix hidden-xs"><hr></div>

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

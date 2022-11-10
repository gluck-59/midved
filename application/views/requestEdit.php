<?php
//	prettyDump($request);
//	prettyDump($payments);


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
			case 0: $paymentType = (is_null($payment->note) || empty($payment->note) ? 'Работа' : $payment->note); break;
			case 1: $paymentType = (is_null($payment->note) || empty($payment->note) ? 'Накладные' : $payment->note); break;
			case 2: $paymentType = '<i class="glyphicon glyphicon-star" title="Авторазноска"></i>&nbsp;'.(is_null($payment->note) || empty($payment->note) ? 'Работа' : $payment->note); break;       // авторазноска
			case 3: $paymentType = '<i class="glyphicon glyphicon-star" title="Авторазноска"></i>&nbsp;'.(is_null($payment->note) || empty($payment->note) ? 'Накладные' : $payment->note); break;       // авторазноска
		}


		$tableHtml .= '<tr id="'.$payment->id.'">
			<td><input class="editPayment form-control" data-entity="created" value="'.$payment->created.'" ></td>
			<td><input class="editPayment form-control" data-entity="sum" value="'.round($payment->sum, 0).'"></td>
			<td><a href="#" class="1editPayment" data-entity="note"><span class="'.$tableHtmlSpanClass.'">'.$paymentType.'</span></a></td>
			<td><button type="button" class="close deletePayment" id="'.$payment->id.'"><i class="glyphicon glyphicon-remove"></i></button></td>
		</tr>';

	}
?>


<!--главная таблица-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7 col-lg-6 col-xs-12">
			<div class="row">
				<div class="col-md-5 col-lg-5 col-xs-8">
					<h3>
						Заявка №<?=$request->id?>&nbsp;
<!--						<small class="label label-default 1hidden-xs">--><?//=$status?><!--</small>-->
						<small class="hidden-xs">баланс</small>
						<small class="<?=$sumStatus?>"><?=$currency->format($request->sum)?>&nbsp;₽</small>
					</h3>
				</div>
				<h3>
					<div class="btn-group col-xs-4">
                        <button type="button" class="btn btn-info dropdown-toggle pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?=RequestModel::STATUSES[$request->status]?> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <?php
                                for ($i = 0; $i <= sizeof(RequestModel::STATUSES); $i++) { ?>
                                    <li><a href="#" class="selectStatus" id="<?=$i?>"><?=RequestModel::STATUSES[$i]?></a></li>
                            <?php } ?>
                        </ul>
					</div>
				</h3>
				<div class="col-xs-9">
					<a href="/request"><span class="label label-info"><i class="glyphicon glyphicon-arrow-left"></i></span></a>
					<span class="text-muted">созд</span> <?=$request->created?> <span class="text-muted">обнов</span> <?=$request->updated?>
				</div>
			</div>

			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<div class="col-md-6 col-lg-6 col-xs-12">
					<div class="items_container">
						<div class="items_head">Работы</div>
						<div class="items_value">
							<?=$request->name?>
						</div>
						<a href="https://www.google.ru/maps/place/<?=$request->city.' '.$request->address?>" target="_blank"><?=$request->city . ' ' . $request->address?> </a>
					</div>
				</div>

				<div class="col-md-6 col-lg-6 col-xs-12">
					<div class="items_container">
						<div class="items_head">Оборудование</div>
						<div class="items_value">
						<?=$request->equipment?> <?=$request->mark?> <span class="text-muted"> s/n <?=$request->serial?> </span>
							<div id="equipmentDetails" role="presentation" class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
									Подробно
									<span class="caret"></span>
								</a>
								<div class="dropdown-menu" aria-labelledby="" style="width: 30em; max-width: 80vw; padding: 5px;">
									<div class='items_value' style="opacity: 0.6">
										<?=str_ireplace("\n", '<br>', $request->equipment_notes)?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-6 col-xs-12">
					<div class="items_container">
						<div class="items_head">Заказчик</div>
						<div class="items_value">
							<?=$request->customer_name?>
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-9 col-lg-9 col-xs-12">
					<div class="items_container">
						<center class="items_value">
                            <div class="row">
                                <div class="col-xs-6 text-right">
                                    <h1><b class="text-danger"><?=$currency->format($rashod)?> </b><span class="text-muted"> ₽</span></h1>
                                </div>
                                <div class="col-xs-6 text-left">
                                    <h1><b class="text-success"><?=$currency->format($prihod)?> </b><span class="text-muted"> ₽</span></h1>
                                </div>
                            </div>
							<div class="row">
								<div class="col-xs-6 text-right">
									<div class="btn btn-danger paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Работа: расход" data-type="false" data-direction="0">Work</div>
									<div class="btn btn-danger paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Накладные: расход" data-type="true" data-direction="0">Extra</div>
								</div>

								<div class="col-xs-6 text-left">
									<div class="btn btn-success paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Работа: приход" data-type="false" data-direction="1" >Work</div>
									<div class="btn btn-success paymentEdit" data-toggle="modal" data-target="#modalPrihodRashod" data-request-id="<?=$request->id?>" data-modal-name="Накладные: приход" data-type="true" data-direction="1">Extra</div>
								</div>
							</div>
						</center>
					</div>
				</div>

				<div class="clearfix hidden-xs">&nbsp;</div>

				<div class="col-md-9 col-lg-8 col-xs-12">
					<div class="items_container">
						<div class="items_head">Заметки</div>
						<center class="items_value">
							<textarea id="requestNotes" data-request-id="<?=$request->id?>" class="form-control"><?=$request->notes?></textarea>
						</center>
					</div>
				</div>
			</div>

			<div class="clearfix hidden-xs">&nbsp;</div><div class="clearfix hidden-xs"><hr></div>

			<div class="row">
				<div class="col-md-10 col-lg-7 col-xs-12">
					<div class="items_container">
						<div class="items_head">История</div>
						<div class="items_value">
							<table id="paymentsHistoryData" class="1table table-responsive table-striped table-condensed 1table-border" style="/*margin: 0 -30px; width: 100vw;*/">
								<thead>
								<tr>
									<th>Дата</th>
									<th width="100px">Сумма</th>
									<th>Статья</th>
									<th>Del.</th>
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
<input hidden id="requestId" value="<?=$request->id?>">
<script>
    /**
     * заменяет все найденные омера телефонов на ссылки
     * @param text
     */
    function autoTel(text) {
        console.log('autoTel');
        /*var elements = document.querySelectorAll('#requestNotes'),
            reg = /(?:\+|\d)[\d\-\(\) ]{9,}\d/g;

        Array.prototype.forEach.call(elements, function(el){
            var el2 = el.innerHTML.replace( reg, function(i) {
                return '<a href="tel:' + i + '">' + i + '</a>';
            } );
            el.innerHTML = el2;
        });*/
    }

    // autoTel($('#requestNotes').val());


</script>
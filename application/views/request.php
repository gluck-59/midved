<?php
//	prettyDump($requests[0]);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-xs-12">
			<h3>Заявки <small class="text-muted">список</small></h3>
<!--			<p class="text-muted">Наверное еще надо возможность добвлять и редактировать. Удалять думаю будет низзя.</p>-->
		</div>
	</div>

    <?php
    if (1 || empty($requests)) { ?>
        <div class="row">
            <div class="col-xs-12 col-lg-6">
                <div class="alert alert-info" role="alert">
                    Создайте Заявку для Оборудования клиента. Заявка может отражать например ремонт оборудования или любые другие операции с ним. <br><br>
                    Заявки имеют статусы
                    <?php foreach (RequestModel::STATUSES as $key => $value) {
                    echo '<span class="btn btn-xs btn-info">'.$value.'</span>&nbsp;';
                    } ?>
                    и поддерживают операции приходов-расходов. <br><br>
                    Система учитывает произведенные над Заявками работы и (по желанию) учет этих приходов-расходов в разрезе Клиентов.
                </div>
            </div>
        </div>
    <?php } ?>

	<div class="row">
		<div class="col-lg-2 col-xs-12">
			<div class="btn-block">
				<button type="button" class="btn btn-success btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-request">Новая заявка</button>
			</div>
		</div>

		<div class="clearfix hidden-xs">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-xs-12">
		<table id="requests" class="table table-condensed table-bordered table-condensed">
			<thead>
			<th>Станок/Клиент</th>
			<th>Заявка</th>
			<th>Баланс</th>
			<th>Даты</th>
			</thead>
			<?php
				foreach ($requests as $request) {
					if ($request->status == 0) {
						$trClass = 'danger';
						$status = 'Новая';
					} elseif ($request->status == 1) {
						$trClass = 'success';
						$status = 'В работе';
					} elseif ($request->status == 2) {
						$trClass = '';
						$status = 'Готово';
					}

					$amountClass = 'label-success';
					if ($request->sum < 0) $amountClass = 'label-danger';

					?>
					<tr class="<?=$trClass?>">
						<td><span><?=$request->equipment .' '.$request->mark.'<br><span class="text-muted">'.$request->customer. ' '.$request->city.', '.$request->address?></span></td>
						<td><a href="/request/edit/<?=$request->id?>">№<?=$request->id?>: <?=$request->name?></a></td>
						<td><span class="label <?=$amountClass?>"><?=round($request->sum, 2)?>&nbsp;₽</span><!--br><a href="#" class="text-muted">история</a--></td>
						<td><span class="text-muted"><?=$request->created?></span><br><?=$request->updated?></td>
					</tr>
				<?php }	?>
		</table>
		</div>
	</div>
</div>

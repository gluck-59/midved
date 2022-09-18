<?php
//	prettyDump($requests[0]);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<h3>Заявки <small class="text-muted">просто список</small></h3>
			<p class="text-muted">Наверное еще надо возможность добвлять и редактировать. Удалять думаю будет низзя.</p>


			<table class="table table-condensed table-bordered table-condensed">
				<thead>
				<th>Станок/Клиент</th>
				<th>Заявка</th>
				<th>Стоимость</th>
				<th>Даты</th>
				</thead>
				<?php
					foreach ($requests as $request) {
						$trClass = 'success';
						$status = 'Новая';
						if ($request->status == 1) {
							$trClass = 'danger';
							$status = 'В работе';
						} elseif ($request->status == 2) {
							$trClass = '';
							$status = 'Готово';
						}

						?>
						<tr class="<?=$trClass?>">
							<td><span><?=$request->equipment .' '.$request->mark.'<br><span class="text-muted">'.$request->customer. ' '.$request->address?></span></td>
							<td><?=$request->name?></td>
							<td><?=round($request->price, 2)?>р.<br><span class="label label-info">транзакции</span></td>
							<td><?=$request->created?><br><span class="text-muted"><?=$request->updated?></span> </td>
						</tr>
					<?php }	?>
			</table>
		</div>
	</div>
</div>
<!--div class="starter-template">
	<div class="row">
		<div class="col-md-2"
		<div class="btn-block">
			<button type="button" class="btn btn-success btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-request">Новая заявка</button>
		</div>
	</div>
</div-->


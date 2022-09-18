<?php
//	prettyDump($requests[0]);
?>

<table class="table table-condensed table-bordered table-condensed">
	<thead>
	<th>Станок/Клиент</th>
	<th>Заявка</th>
	<th>Стоимость</th>
	<th>Созд/Обн</th>
	</thead>
	<?php
		foreach ($requests as $request) {
			$trClass = 'danger';
			$status = 'Новая';
			if ($request->status == 1) {
				$trClass = 'warning';
				$status = 'В работе';
			} elseif ($request->status == 2) {
				$trClass = 'success';
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



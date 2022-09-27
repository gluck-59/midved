<?php
//	prettyDump($result);
//	prettyDump($tableColumns);
?>

<div class="container-fluid">
	<h3>Запросы <small class="text-muted">к базе даных</small></h3>
	<p class="text-muted">Разрешены SELECT и JOIN. Структура базы сам знаешь где. Первое слово в запросе — &laquo;SELECT&raquo;.</p>
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<?php if (!is_array($result)) echo $result; ?>
			<table class="table table-bordered table-condensed table-responsive table-striped">
				<?php
				foreach ($result as $rows) {
					echo '<tr>';
						foreach ($rows as $row) { ?>
							<td><?=print_r($row, 1)?></td>
						<?php }
					echo '</tr>';
				} ?>
			</table>
		</div>
	</div>

	<form method="post" action="/report">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<textarea name="sql" class="form-control" style="width: 100%; verflow-y: hidden; /*height: 20vh;*/"><?=$request['sql']?></textarea>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix"><hr></div>
			<div class="col-xs-12 col-md-4 text-right">
				<input type="reset" onclick="$('[name=sql]').text('')" class="btn btn-warning" value="Очистить">
				<input type="submit" class="btn btn-success" value="Отправить">
			</form>
		</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>

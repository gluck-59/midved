<?php
//	prettyDump($result);
//	$tableColumns = sizeof($result);

//	prettyDump($tableColumns);
?>

<div class="container-fluid">
	<h3>Запросы <small class="text-muted">к базе</small></h3>
	<p class="text-muted">Разрешены SELECT и JOIN. Имена таблиц возьмешь сам знаешь где.</p>
	<div class="row">
		<div class="col-xs-12 col-md-4">
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

	<div class="clearfix">&nbsp;</div>

	<div class="row">
		<form method="post" action="/report">
			<div class="col-xs-12 col-md-4">
				<textarea name="sql" style="width: 100%; height: 20vh;"><?=$request['sql']?></textarea>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="col-xs-12 col-md-4">
				<input type="reset" onclick="$('[name=sql]').text('')" class="btn btn-warning" value="Очистить">
				<input type="submit" class="btn btn-success" value="Отправить">
			</div>
		</form>
	</div>
</div>
<script>

</script>

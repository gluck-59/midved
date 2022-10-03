<?php
//	prettyDump($result[0]);
//	prettyDump($stopWords);
?>

<div class="container-fluid">
	<h3>Запросы <small class="text-muted">к базе даных</small></h3>
	<p class="text-muted">Разрешены SELECT и JOIN. Структуру базы можно взять у разработчиков. Первое слово в запросе — &laquo;SELECT&raquo;.</p>
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<?php if (!empty($stopWords[0])) { ?>
				<h4>Низзя:</h4>
			<?php
				foreach ($stopWords[0] as $stopWord) { ?>
						<h4><span class="label label-danger"><?=$stopWord?></span></h4>
				<?php } ?>
			<?php } ?>
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

	<div class="row">
		<div class="col-xs-12">

		</div>
	</div>

	<div class="clearfix">&nbsp;</div>

	<form method="post" action="/report">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<textarea name="sql" class="form-control" style="width: 100%; verflow-y: hidden; /*height: 20vh;*/"><?=$request['sql']?></textarea>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix"><hr></div>
			<div class="col-xs-12 col-md-4 text-right">
				<input type="reset" onclick="$('[name=sql]').text('')" class="btn btn-warning" value="Очистить">
				<input type="submit" name="toFile" class="btn btn-info" value="Результат в Excel">
				<input type="submit" class="btn btn-success" value="Запрос">
			</form>
		</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>

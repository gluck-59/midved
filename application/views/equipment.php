<?php
//	prettyDump($equipments[0]);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<h3>Оборудование <small class="text-muted">просто список</small></h3>
<!--			<p class="text-muted">Наверное еще надо возможность добвлять и редактировать. Удалять думаю будет низзя.</p>-->

			<table class="table table-condensed table-bordered table-condensed">
				<thead>
				<th>Название/Клиент</th>
				<th>Адрес</th>
				</thead>
				<?php
					foreach ($equipments as $equipment) { ?>
						<tr>
							<td><?=$equipment->name?>&nbsp;<?=$equipment->mark?><br><span class="text-muted"><?=$equipment->customer?></span></td>
							<td><?=$equipment->address?></td>
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


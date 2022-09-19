<?php
//		prettyDump($customers);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<h3>Клиенты <small class="text-muted">просто список</small></h3>
			<!--			<p class="text-muted">Наверное еще надо возможность добвлять и редактировать. Удалять думаю будет низзя.</p>-->

			<table class="table table-condensed table-bordered table-condensed">
				<thead>
				<th>Название</th>
<!--				<th>Адрес</th>-->
				</thead>
				<?php
					foreach ($customers as $customer) { ?>
						<tr>
							<td><?=$customer->name?></td>
						</tr>
					<?php }	?>
			</table>
		</div>
	</div>
</div>

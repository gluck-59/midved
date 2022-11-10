<?php
//		prettyDump($customers);
//	prettyDump($requests[0]);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-xs-12">
			<h3>Клиенты <small class="text-muted">список</small></h3>
<!--			<p class="text-muted"></p>-->
		</div>
	</div>

	<div class="row">
		<div class="col-lg-2 col-xs-12">
			<div class="btn-block">
				<button id="newCilent" class="btn btn-success btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-customer">Новый клиент</button>
			</div>
		</div>

		<div class="clearfix hidden-xs">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<table id="customers" class="table table-condensed table-bordered table-condensed">
				<thead>
				<th>Название</th>
				<th></th>
				</thead>
				<?php
					foreach ($customers as $customer) { ?>
						<tr>
							<td>
								<a href="#" id="" data-toggle="modal" data-target="#modal-customer" data-customer_id="<?=$customer->id?>" data-name="<?=$customer->name?>" data-data="<?=$customer->data?>" ><?=$customer->name?></a>
								<br>
								<span class="small text-muted"><?=$customer->data?></span>
							</td>
							<td>
                                <center><button type="button" class="close deleteCustomer" id="<?=$customer->id?>"><i class="glyphicon glyphicon-remove"></i></button></center></td>
						</tr>
					<?php }	?>
			</table>

		</div>
	</div>
</div>



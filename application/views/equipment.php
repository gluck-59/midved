<?php
//	prettyDump($equipments[0]);
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-xs-12">
			<h3>Оборудование <small class="text-muted">список</small></h3>
		</div>
	</div>

    <?php if (1 || empty($equipments)) { ?>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="alert alert-info" role="alert">
                    Теперь создайте Оборудование вашего Клиента.<br><br>
                    Это могут быть станки, компьютерная или автомобильная техника — всё что требует выполнения некоторых "наземных" операций с Вашим участием.<br><br>
                    Вы заносите произведенные операции в Заявках, а система учитывает их и (по желанию) ведёт учет доходов-расходов по ним.
                </div>
            </div>
        </div>
    <?php } ?>

	<div class="row">
		<div class="col-lg-2 col-xs-12">
			<div class="btn-block">
				<button type="button" class="btn btn-success btn-lg btn-block btn-open-modal"  data-toggle="modal" data-target="#modal-equipment">Новое оборудование</button>
			</div>
		</div>

		<div class="clearfix hidden-xs">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
	</div>
	<div class="row">
        <div class="col-xs-12 col-md-4">
			<table id="equipments" class="table table-condensed table-bordered table-condensed">
				<thead>
				<th>Название</th>
				<th>Адрес</th>
				<th></th>
				</thead>
				<?php
					foreach ($equipments as $equipment) { ?>
					<td>
						<a href="#" id="editEquipment" data-equipment_id="<?=$equipment->id?>" data-customer_id="<?=$equipment->customer_id?>" data-name="<?=$equipment->name?>" data-mark="<?=$equipment->mark?>" data-city="<?=$equipment->city?>" data-address="<?=$equipment->address?>" data-serial="<?=$equipment->serial?>" data-notes="<?=$equipment->notes?>" data-toggle="modal" class="btn-open-modal" data-target="#modal-equipment">
							<?=$equipment->name?>&nbsp;<?=$equipment->mark?><br>
							<span class="text-muted"><?=$equipment->customer?></span>
						</a>
					</td>
					<td><?=$equipment->city?> <?=$equipment->address?></td>
					<td>
                        <center><button type="button" class="close deleteEquipment" id="<?=$equipment->id?>"><i class="glyphicon glyphicon-remove"></i></button></center>
                    </td>
				</tr>
				<?php }	?>
			</table>

		</div>
	</div>
</div>



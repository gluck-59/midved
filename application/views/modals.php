<?php
//	prettyDump($requests[0]);
?>
<!-- Modal request -->
<div class="modal fade" id="modal-request" tabindex="-1" role="dialog" aria-labelledby="requestLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="requestLabel">Заявка</h4>
			</div>
			<div class="modal-body">
				<select class="selectpicker" id="customer" data-live-search="true" title="Выберите клиента...">
					<?php
						foreach ($customers as $customer) { ?>
							<option value="<?=$customer->id?>" data-subtext="<?=$customer->address?>"><?=$customer->name?></option>
						<?php } ?>
				</select>

				<div class="clearfix">&nbsp;</div>

				<select class="selectpicker" id="equipment" data-live-search="true" title="Выберите станок...">
					<?php
						foreach ($equipments as $equipment) { ?>
							<option value="<?=$equipment->id?>" data-subtext="<?=$equipment->customer_name?>&nbsp;<?=$equipment->equipment_mark?>"><?=$equipment->equipment_name?>&nbsp;<?=$equipment->mark?></option>
						<?php } ?>
				</select>

				<div class="clearfix">&nbsp;</div>

				<input type="text" class="form-control" placeholder="Описание заявки">
				<div class="clearfix">&nbsp;</div>

				<p>Выбираешь клиента и станок. Забиваешь новую заявку.</p>
				<p>Связь "клиент-станок" пока не прописана. Заявка не сохраняется. Не ссать, это демо.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success">OK</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal payment -->
<div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="paymentLabel">Платеж</h4>
			</div>
			<div class="modal-body">
				<select class="selectpicker" data-live-search="true" title="Выберите заявку...">
					<?php
						foreach ($requests as $request) { ?>
							<option value="<?=$request->id?>" data-subtext="<?=$request->equipment?>&nbsp;<?=$request->mark?> — <?=$request->customer?>"><?=$request->name?></option>
						<?php } ?>
				</select>
				<div class="clearfix">&nbsp;</div>
				<input type="number" class="form-control" placeholder="Сумма">
				<div class="clearfix">&nbsp;</div>

				<p>Заявка, в которую нужно добавить платеж</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success">OK</button>
			</div>
		</div>
	</div>
</div>

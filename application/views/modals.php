<?php
//	prettyDump($requests[0]);
?>
<!-- Modal request -->
<div class="modal fade" id="modal-request" tabindex="-1" role="dialog" aria-labelledby="requestLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove" style="zoom: 2;"></i></button>
				<h4 class="modal-title" id="requestLabel">Новая заявка&nbsp;<small>на ремонт</small></h4>
			</div>
			<div class="modal-body">
				<select class="" name="customers" data-live-search="true" title="Выберите клиента..."></select>
				<div class="clearfix">&nbsp;</div>
				<select class=""  name="equipments" data-live-search="true" title="Выберите станок..."></select>
				<div class="clearfix">&nbsp;</div>

				<input type="text" class="form-control" id="desc" placeholder="Описание заявки">
				<div class="clearfix">&nbsp;</div>

				<p>Выбираешь клиента и станок. Забиваешь новую заявку. Подробности описываешь внутри. Полноценного лога не делал, чай не многопользовательский CRM :)</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success" id="addRequest">OK</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal payment -->
<div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove" style="zoom: 2;"></i></button>
				<h4 class="modal-title" id="paymentLabel">Платеж</h4>
			</div>
			<div class="modal-body">
				<select class="" name="requests" data-live-search="true" title="Выберите заявку..."></select>
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



<!-- Modal newCustomer -->
<div class="modal fade" id="newCustomer" tabindex="-1" role="dialog" aria-labelledby="newCustomer" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove" style="zoom: 2;"></i></button>
				<h4 class="modal-title" id="paymentLabel">Клиент</h4>
			</div>
			<div class="modal-body">
				<input type="text" id="name" class="form-control" placeholder="Название">
				<div class="clearfix">&nbsp;</div>
				<textarea type="text" id="addidionalData" class="form-control" placeholder="Какие-то дополнительные данные"></textarea>
				<div class="clearfix">&nbsp;</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" id="createCustomer" class="btn btn-success">OK</button>
			</div>
		</div>
	</div>
</div>




<!-- Modal newEquipment -->
<div class="modal fade" id="modal-equipment" tabindex="-1" role="dialog" aria-labelledby="newEquipment" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove" style="zoom: 2;"></i></button>
				<h4 class="modal-title" id="">Оборудование</h4>
			</div>
			<div class="modal-body">
				<div class="clearfix">&nbsp;</div>
				<select class="" name="customers" data-live-search="true" title="Выберите клиента..."></select>
				<div class="clearfix">&nbsp;</div>

				<input hidden id="equipmentId">
				<input hidden id="customerId">
				<input type="text" id="name" class="form-control" placeholder="Название оборудования (обязательно)">
				<div class="clearfix">&nbsp;</div>
				<input type="text" id="mark" class="form-control" placeholder="Марка/модель">
				<div class="clearfix">&nbsp;</div>
				<input type="text" id="city" class="form-control" placeholder="Город">
				<div class="clearfix">&nbsp;</div>
				<input type="text" id="address" class="form-control" placeholder="Адрес установки оборудования">
				<div class="clearfix">&nbsp;</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" id="saveEquipment" class="btn btn-success">OK</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal prihod-rashod -->
<div class="modal fade" id="modalPrihodRashod" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove" style="zoom: 2;"></i></button>
				<h3 class="modal-title" id="prihod_rashod"></h3>
				<select id="requestList" data-live-search="true" title="В какую заявку платеж?"></select>
				<label for="paymentType" style="vertical-align: -webkit-baseline-middle;">
					<input type="checkbox" id="paymentType" name="paymentType" class="1form-control" style="zoom: 1.3;">
					работа
				</label>
			</div>
			<div class="modal-body">
				<input type="number" pattern="[0-9]*" id="sum" class="form-control" style="zoom: 3;">
				<input hidden id="requestId" placeholder="заявка #">
				<input hidden id="typePayment" placeholder="тип">
				<input hidden id="direction" placeholder="direction">
				<div class="clearfix">&nbsp;</div>
			</div>

			<div id="keyboard">
				<div class="row-fluid">
					<a href="#" class="btn key" data-key="55">7</a>
					<a href="#" class="btn key" data-key="56">8</a>
					<a href="#" class="btn key" data-key="57">9</a>
				</div>
				<div class="row-fluid">
					<a href="#" class="btn key" data-key="52">4</a>
					<a href="#" class="btn key" data-key="53">5</a>
					<a href="#" class="btn key" data-key="54">6</a>
				</div>
				<div class="row-fluid">
					<a href="#" class="btn key" data-key="49">1</a>
					<a href="#" class="btn key" data-key="50">2</a>
					<a href="#" class="btn key" data-key="51">3</a>
				</div>
				<div class="row-fluid">
					<a href="#" class="btn btn-danger" onclick="$('#sum').val('')">C</a>
					<a href="#" class="btn key" data-key="48">0</a>
					<a href="#" class="btn btn-success" id="calculate">OK</a>
				</div>
			</div>

			<div class="modal-body">
			<input type="text" id="notes" class="form-control" value="" placeholder="Заметка">
			</div>
		</div>
	</div>
</div>


<script>
	$('select').selectpicker();

	// при открытии модала расставим заголовки
	$('.modal').on('show.bs.modal', function (event) {
		let sumInput = $('#sum');
		let button = $(event.relatedTarget)
		let modalName = button.data('modal-name')
		let requestId = button.data('request-id')

		let modal = $(this);
		// платежи
		modal.find('.modal-title').text(modalName);
		modal.find('#requestId').val(requestId);
		modal.find('#typePayment').val(button.data('type'));
		modal.find('#direction').val(button.data('direction'));

		// оборудование (@TODO сделать универсальный заполнятель)
		// заполнение полей на редактирование
		console.log('заполняем',button.data())
		modal.find('#equipmentId').val(button.data('equipment_id'));
		modal.find('#customerId').val(button.data('customer_id'));
		modal.find('#name').val(button.data('name'));
		modal.find('#mark').val(button.data('mark'));
		modal.find('#city').val(button.data('city'));
		modal.find('#address').val(button.data('address'));

		sumInput.val('');
		// console.log(button.data());

		/** экранная клава */
		// покрасим кнопки
		let color = (button.data('direction') == 0 ? '#fcc' : '#afa');
		$('.row-fluid > a.btn').css('border-color', color);

		// отработаем нажатия
		$('#keyboard .row-fluid .btn.key').on('click', function (event) {
			// let keyboard = $(event.currentTarget);
			sumInput.val($('#sum').val() + $(event.currentTarget).text())
		})
		/** /экранная клава */



		// это модал платежа с главной
		if (modal.attr('id') == 'modalPrihodRashod' && requestId == 0 ) {
			fillRequestSelect();
		} else {
			$('select#requestList').selectpicker("hide");
			// скрыть чекбокс
		}
		// это модал создания нового клиента
		// if (modal.attr('id') == 'newCustomer' && requestId == 0 ) {
		// 	createCustomer(modal);
		// }
	})


	// при закрытии модала нужно откл обработку нажатий на экранную клаву
	$('.modal').on('hidden.bs.modal', function (event) {
		$('#keyboard .row-fluid .btn.key').off();
	} )

	// заполним селект клиентов сразу после вызова модала
	$('#modal-request, #modal-equipment').on('show.bs.modal', function (e) {
		console.log('загружен модал'+e.currentTarget.id)
		$.getJSON( "/customer/getAll", function( data ) {
			let select = $('[name=customers]');
			select.text('');
			select.selectpicker("refresh");
			$.each(data, function (index, currentObject) {
				var option = new Option();
				$(option).html(currentObject.name);
				$(option).val(currentObject.id);
				select.append(option);
			})
			select.selectpicker("refresh");


			// если это #modal-equipment и equipment_id непустое, то это редактирование оборудования и нужно установть селектор
			if ($(e.currentTarget).find('#customerId').val() != '') {
				$('[name=customers]').selectpicker("val", $(e.currentTarget).find('#customerId').val());
			}
		});
	})



	$('[name=customers]').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
		console.log('name=customers событие select', clickedIndex)
		$.getJSON( "/equipment/getEquipmentByCustomerId/"+clickedIndex, function( data ) {
			let select = $('[name=equipments]');
			select.html('');
			$.each(data, function (index, currentObject) {
				console.log('currentObject', currentObject);
				var option = new Option();
				$(option).html(currentObject.name+' '+currentObject.mark);
				$(option).val(currentObject.id);
				$(option).attr('data-subtext', currentObject.city+ ' ' +currentObject.address);
				select.append(option);
			})
			$('[name=equipments]').selectpicker("refresh")
		})

	});



</script>

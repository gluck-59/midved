<?php
//	prettyDump($requests[0]);
?>
<!-- Modal request -->
<div class="modal fade" id="modal-request" tabindex="-1" role="dialog" aria-labelledby="requestLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"style="float: right;"><i class="glyphicon glyphicon-remove"></i></button>
				<h4 class="modal-title" id="requestLabel">Новая заявка&nbsp;<small>на ремонт</small></h4>
			</div>
			<div class="modal-body">
				<select class="" name="customers" data-live-search="true" title="Сначала выберите клиента..."></select>
				<div class="clearfix">&nbsp;</div>
				<select class=""  name="equipments" data-live-search="true" title="Затем выберите оборудование..."></select>
				<div class="clearfix">&nbsp;</div>

				<input required type="text" class="form-control" id="desc" placeholder="Краткое описание заявки (обязательно)">
				<div class="clearfix">&nbsp;</div>

				<p>Выберите клиента и оборудование для ремонта. Подробности заявки можно будет добавлять и изменять внутри заявки на всем ее жизненном цикле.</p>
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
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right;"><i class="glyphicon glyphicon-remove"></i></button>
				<h4 class="modal-title" id="paymentLabel">Платеж</h4>
			</div>
			<div class="modal-body">
				<select class="" name="requests" data-live-search="true" title="Выберите заявку..."></select>
				<div class="clearfix">&nbsp;</div>
				<input required type="number" class="form-control" placeholder="Сумма">
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



<!-- Modal Customer -->
<div class="modal fade" id="modal-customer" tabindex="-1" role="dialog" aria-labelledby="newCustomer" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right;"><i class="glyphicon glyphicon-remove"></i></button>
				<h4 class="modal-title" id="paymentLabel">Клиент</h4>
			</div>
			<div class="modal-body">
				<input hidden id="customerId" placeholder="customerId">
                <input hidden id="parentId" placeholder="parentId">
                <div class="form-group">
                    <label>Родитель</label>
                    <select required="true" class="" name="customers" data-live-search="true" title=""></select>
                </div>
                <div class="form-group">
                    <label>Название</label>
                    <input required="true" type="text" id="name" class="form-control" placeholder="Название (обязательно)">
                    <div class="clearfix">&nbsp;</div>
				    <textarea type="text" id="data" class="form-control" placeholder="Дополнительные данные"></textarea>
                </div>
            </div>



			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="submit" id="saveCustomer" class="btn btn-success">OK</button>
			</div>
		</div>
	</div>
</div>




<!-- Modal Equipment -->
<div class="modal fade" id="modal-equipment" tabindex="-1" role="dialog" aria-labelledby="newEquipment" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right;"><i class="glyphicon glyphicon-remove"></i></button>
				<h4 class="modal-title" id="">Оборудование</h4>
			</div>
			<div class="modal-body">
				<div class="clearfix">&nbsp;</div>
				<select class="" name="customers" data-live-search="true" title="Выберите клиента..."></select>
				<div class="clearfix">&nbsp;</div>

				<input hidden id="equipmentId">
				<input hidden id="customerId">
				<div class="row">
					<div class="col-xs-6">
						<input required type="text" id="name" class="form-control" placeholder="Название (обязательно)">
					</div>
					<div class="col-xs-6">
						<input type="text" id="mark" class="form-control" placeholder="Марка/модель">
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<input type="text" id="serial" class="form-control" placeholder="Серийный номер">
				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="col-xs-6">
						<input type="text" id="city" class="form-control" placeholder="Город">
					</div>
					<div class="col-xs-6">
						<input type="text" id="address" class="form-control" placeholder="Адрес установки">
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="col-xs-12">
						<textarea id="notes" class="form-control" placeholder="Дополнительные данные"></textarea>
					</div>
				</div>
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
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right;"><i class="glyphicon glyphicon-remove"></i></button>
				<h3 class="modal-title" id="prihod_rashod"></h3>
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<select id="requestList" data-live-search="true" title="В какую заявку?" data-width="150"></select>
					</div>
					<div class="col-xs-4">
						<div class="checkbox" id="paymentTypeWrapper">
							<label>
								<input type="checkbox" id="paymentType" name="paymentType" class="1form-control" style="/*zoom: 1.3;*/">
								работа
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<input type="number" pattern="[0-9]*" id="" class="sum form-control" style="zoom: 3;">
				<input hidden id="requestId" placeholder="заявка #">
				<input hidden id="typePayment" placeholder="тип">
				<input hidden id="direction" placeholder="direction">
				<div class="clearfix">&nbsp;</div>
			</div>

			<div id="keyboard" class="hidden-sm hidden-md hidden-lg">
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
					<a href="#" class="btn btn-danger" onclick="$('.sum').val('')">C</a>
					<a href="#" class="btn key" data-key="48">0</a>
					<a href="#" class="btn btn-success calculate" >OK</a>
				</div>
			</div>


			<div class="modal-body">
				<input type="text" id="notes" maxlength="14" class="form-control" value="" placeholder="Заметка">
			</div>

			<div class="modal-footer hidden-xs">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success calculate">OK</button>
			</div>
		</div>
	</div>
</div>



<!-- Modal auto distribution  -->
<div class="modal fade" id="modalAutoDistribution" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right;"><i class="glyphicon glyphicon-remove"></i></button>
				<h3 class="modal-title" id="prihod_rashod">Авторазноска платежа</h3>
			</div>
			<div class="modal-body">
				<input type="number" pattern="[0-9]*" id="" class="sum form-control" style="zoom: 3;">
				<input hidden id="requestId" placeholder="заявка #">
				<input hidden id="typePayment" placeholder="тип">
				<input hidden id="direction" placeholder="direction">
				<div class="clearfix">&nbsp;</div>

                <div class="row">
                    <div class="col-xs-12">
                        <select id="customerList" data-live-search="true" title="От кого платеж?"></select>
<!--                        <select id="customers" data-live-search="true" title="От кого платеж?"></select>-->
                    </div>
                </div>
            </div>
			<div id="keyboard" class="hidden-sm hidden-md hidden-lg">
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
					<a href="#" class="btn btn-danger" onclick="$('.sum').val('')">C</a>
					<a href="#" class="btn key" data-key="48">0</a>
					<a href="#" class="btn btn-success calculate" >OK</a>
				</div>
			</div>


			<div id="modalAutoDistributionReport" class="modal-body">
                <div class="alert alert-info" role="alert">
                    <p>Цель автоматической разноски платежа — взять незакрытые заявки с отрицательным балансом, довести баланс до 0.</p>
                    <p>Прежде всего корректируется самые старые заявки с отрицательным балансом и статусом, отличным от «<?=RequestModel::STATUSES[2]?>».</p>
                </div>
                <div class="alert alert-warning" role="alert">
                    <p>Сначала компенсируются накладные расходы, затем работы.</p>
                </div>
                <div class="alert alert-warning" role="alert">
                    <p>Если суммы платежа не хватит на все подходящие заявки, остаток упадет в очередную подходящую.</p>
				    <p>Если сумма платежа больше дебиторской задолженности, компенсируются все старые заявки, излишек упадет на самую новую.</p>
                </div>
			</div>

			<div class="modal-footer hidden-xs">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success calculate">OK</button>
			</div>

		</div>
	</div>
</div>


<script>
	$('select').selectpicker();
	var currentModalId;

	// при открытии модала расставим заголовки
	$('.modal').on('shown.bs.modal', function (event) {
		let sumInput = $('.sum');
		let button = $(event.relatedTarget)
		let modalName = button.data('modal-name')
		let requestId = button.data('request-id')
        currentModalId = button.data('target');
		console.warn('загружен модал currentModalId', currentModalId );
// console.log('modals.php', event.currentTarget.id)

		let modal = $(this);
		// платежи
		modal.find('.modal-title').text(modalName);
		modal.find('#requestId').val(requestId);
		modal.find('#typePayment').val(button.data('type'));
		modal.find('#direction').val(button.data('direction'));

		// оборудование (@TODO сделать универсальный заполнятель)
		// заполнение полей на редактирование
        // console.log('заполняем',button.data())
		modal.find('#equipmentId').val(button.data('equipment_id'));
		modal.find('#customerId').val(button.data('customer_id'));
		modal.find('#parentId').val(button.data('parent-id'));
		modal.find('#name').val(button.data('name'));
		modal.find('#mark').val(button.data('mark'));
		modal.find('#city').val(button.data('city'));
		modal.find('#address').val(button.data('address'));
		modal.find('#data').val(button.data('data'));
		modal.find('#serial').val(button.data('serial'));
		modal.find('#notes').val(button.data('notes'));

        // select
        if (currentModalId == '#modal-equipment') {
            modal.find('[name=customers]').selectpicker('val', button.data('customer_id'));
        } else if (currentModalId == '#modal-customer') {
            modal.find('[name=customers]').selectpicker('val', button.data('parent-id'));
        }

		sumInput.focus().val('');

		/** экранная клава */
		// покрасим кнопки
		let color = (button.data('direction') == 0 ? 'rgba(193 84 84 / 60%)' : 'rgba(82 169 82 / 60%)');
		$('.row-fluid > a.btn').css('border-color', color);
		sumInput.css('border-color', color)
		sumInput.css('box-shadow', 'none')

		// отработаем нажатия
		$('#keyboard .row-fluid .btn.key').on('click', function (event) {
			// let keyboard = $(event.currentTarget);
			sumInput.val($('.sum').val() + $(event.currentTarget).text())
		})
		/** /экранная клава */



		// это модал платежа с главной
		if (modal.attr('id') == 'modalPrihodRashod' && requestId == 0 ) {
			fillRequestSelect();
		} else if (modal.attr('id') == 'modalPrihodRashod' && requestId > 0 ) {
			$('select#requestList').selectpicker("hide");
			$('#paymentTypeWrapper').hide();
		}

		// это модал авторазноски с главной
		if (modal.attr('id') == 'modalAutoDistribution') {
			$.getJSON( "/customer/getAll", function( data ) {
				let select = $('#customerList');
				select.text('');

				// если надо и родителей и дочек
				// let allCustomers = data.childs.concat(data.parents)
				// $.each(allCustomers, function (index, currentObject)
				$.each(data.parents, function (index, currentObject)
				{
					var option = new Option();
					$(option).html(currentObject.name);
					$(option).val(currentObject.id);
					// $(option).attr('data-subtext', currentObject.customer+' '+currentObject.city+' '+ currentObject.equipment);
					select.append(option);
				})
				$('select#customerList').selectpicker("refresh");
			});
		}
	}) // /shown.bs.modal



	// при закрытии модала нужно откл обработку нажатий на экранную клаву  чтобы потом цифры не двоились
	$('.modal').on('hidden.bs.modal', function (event) {
		$('#keyboard .row-fluid .btn.key').off();
	} )




	// заполним селект клиентов сразу после вызова модала
	$('#modal-request, #modal-equipment, #modal-customer, #modalAutoDistribution').on('show.bs.modal', function (e) {
		$.getJSON( "/customer/getAll", function( data ) {
			let select = $('[name=customers]');
			select.text('');
// console.log('e.currentTarget.id',e.currentTarget.id)
            if (e.currentTarget.id == 'modal-customer') {
                var option = new Option();
                $(option).html('Клиент верхнего уровня');
                $(option).val(null);
                select.append(option);
            }

			select.selectpicker("refresh");

            // теоресиськи можно объединить родителей с дочками чтобы появилась возможность подчинить дочку другой дочке, но во вьюхе customer настроено отобажение только 0 и 1 уровня
            // let allCustomers = $.merge( data.parents, data.childs )

			$.each(data.parents, function (index, currentObject) {
				var option = new Option();
				$(option).html(currentObject.parentId == null ? currentObject.name : '> '+currentObject.name);
				$(option).val(currentObject.id);
				select.append(option);
			})
			select.selectpicker("refresh");


			// если это #modal-equipment и equipment_id непустое, то это редактирование оборудования и нужно установть селектор
			// if (currentModalId == '#modal-equipment' && $(e.currentTarget).find('#customerId').val() != '') {
            //     console.log('customerId', $(e.currentTarget).find('#customerId').val());
			// 	$('[name=customers]').selectpicker("val", $(e.currentTarget).find('#modal-equipment #customerId').val());
			// }

            // если это #modal-customer и parentId непустое, то это редактирование клиента и нужно установть селектор
			// if (currentModalId == '#modal-customer' && $(e.currentTarget).find('#parentId').val() != '') {
            //     console.log('parentId', $(e.currentTarget).find('#parentId').val())
			// 	$('[name=customers]').selectpicker("val", $(e.currentTarget).find('#modal-customer #parentId').val());
			// }
		});
	})



	$('[name=customers]').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
		// console.log('name=customers событие select', $('[name=customers]').val())
        let customerId = $('[name=customers]').val();
        if (customerId == '') return;
		$.getJSON( "/equipment/getEquipmentByCustomerId/"+customerId, function( data ) {
			let select = $('[name=equipments]');
			select.html('');
			$.each(data, function (index, currentObject) {
				// console.log('currentObject', currentObject);
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

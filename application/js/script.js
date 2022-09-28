$(document).on('ready', function (){
	/**
	 * создает приход-расход
 	 */
	$('#calculate').on('click', function (event) {
		var prihodRashodModal = $('#modalPrihodRashod');
		let sum = $(prihodRashodModal).find('#sum').val();
		if (sum == '') return;
		let requestId =  $(prihodRashodModal).find('#requestId').val() || $('#requestList').val();
		let type =  $(prihodRashodModal).find('#typePayment').val() || prihodRashodModal.find('#paymentType').prop('checked');
		let direction =  $(prihodRashodModal).find('#direction').val();
		let note =  $(prihodRashodModal).find('#notes').val();
		// console.log('отправка', requestId, type, direction, sum, note)


		sendData = {
			'requestId': requestId,
			'type': type,
			'direction': direction,
			'sum': sum,
			'note': note
		};
		console.log('sendData', sendData);
		$.post('/request/payment/', sendData, function (data) {
			console.log('POST /request/payment', data);
			if (data == 'true') location.reload();
		})
	});


	/**
	 * редактирование приход-расход
	 */
	$('.editPayment').on('blur', function (event) {
		let postData = {};
		postData.paymentId = event.currentTarget.parentElement.parentElement.id;
		postData.entity = event.currentTarget.dataset.entity;
		postData.value = event.currentTarget.value;

		$.post('/payment/edit', postData, function (data) {
			// console.log('POST /payment/edit', data, typeof data);
			if (data == 1) location.reload();
		})
	})




	/**
	 * удаление приход-расход
	 */
	$('.deletePayment').on('click', function (event) {
		if (!confirm('Удалить строку?')) return;
		$.post('/payment/delete', {'id': event.currentTarget.id}, function (data) {
			// console.log('POST /payment/delete', data);
			if (data == 'true') location.reload();
		})
	} )


	/**
	 * новая заявка
	 */
	$('#addRequest').on('click', function (event) {
		let modal = $('#modal-request');
		let sendData = {
			'equipments': modal.find('[name=equipments]').val(),
			'desc': modal.find('#desc').val()
		};
		$.post('/request/create/', sendData, function (data) {
			if (data == 1) window.location.href='/request';
		})
	});



	/**
	 * сохраняет заметку в заявке
	 */
	$('#requestNotes').on('blur', function (event) {
		let sendData = {
			'requestId': event.currentTarget.dataset.requestId,
			'notes': $(event.currentTarget).val()
		};
		$.post('/request/setNotes/', sendData, function (data) {
			console.log(data)
		})
	})



	/**
	 * устанавливает статус заявки
	 */
	$('.selectStatus').on('click', function (event) {
		let sendData = {
			'statusId': this.id,
			'requestId': $('#requestId').val()
		};
		$.post('/request/setStatus', sendData, function (data) {
			if (data == 1) window.location.href='/request';
		})
	})




	/**
	 * создает или редактирует клиента
	 */
	$('#saveCustomer').on('click', function (event) {
		let modal = $('.modal#modal-customer');
		let sendData = {
			'customerId': modal.find('#customerId').val(),
			'customerName': modal.find('#name').val(),
			'customerData': modal.find('#data').val(),
		};
		$.post('/customer/save', sendData, function (data) {
			if (data > 0) window.location.href='/customer';
		})
	})



	/**
	* удаляет клиента
	 * затем через базу по цепочке удаляются все связанные станки, заявки и платежи
	 */
	$('.deleteCustomer').on('click', function (event) {
		if (!confirm('При удалении клиента удалятся все его оборудование, документы, заявки и платежи.')) return;
		let sendData = {
			'customerId': this.id,
		};
		$.post('/customer/delete', sendData, function (data) {
			if (data == 1) window.location.href='/customer';
		})
	})



	/**
	 * создает и редактирует оборудование
	 */
	$('#saveEquipment').on('click', function (event) {
		let modal = $('.modal#modal-equipment');
		let sendData = {
			'customerSelector': modal.find('[name=customers]').val(),
			'customerField': modal.find('#customerId').val(),
			'equipmentId': modal.find('#equipmentId').val(),
			'name': modal.find('#name').val(),
			'mark': modal.find('#mark').val(),
			'city': modal.find('#city').val(),
			'address': modal.find('#address').val(),
			'serial': modal.find('#serial').val(),
			'notes': modal.find('#notes').val(),
		};
		$.post('/equipment/save', sendData, function (data) {
			if (data > 0) window.location.href='/equipment';
		})
	})


/**
 * редактирует оборудование
 */
$('.editEquipment').on('click', function (event) {
	let sendData = {
		'id': modal.find('#name').val(),

	};
	$.post('/equipment/edit', sendData, function (data) {
		if (data == 1) window.location.href='/equipment';
	})
})





	/**
	 * удаляет оборудование
	 * затем через базу по цепочке удаляются все связанные станки, заявки и платежи
	 */
	$('.deleteEquipment').on('click', function (event) {
		if (!confirm('При удалении оборудования удалятся все его документы, заявки и платежи.')) return;
		let sendData = {
			'equipmentId': this.id,
		};
		$.post('/equipment/delete', sendData, function (data) {
			if (data == 1) window.location.href='/equipment';
		})
	})





}) // document ready



// кнопки +/- приходы-расходы
$('.paymentEdit').on('click', function (event) {
	// накладные
	if (event.currentTarget.dataset.type == 0) {
		if (event.currentTarget.dataset.direction == 0) { // расход
			console.log('накл расход')
		} else {
			console.log('накл приход')
		}
	}
	//работа
	if (event.currentTarget.dataset.type == 1) {
		if (event.currentTarget.dataset.direction == 0) { // расход
			console.log('работа расход')
		} else {
			console.log('работа приход')
		}
	}
});


// календарь во весь экран
// $("#ical").on('load', function (){
// 	$("#ical").removeClass("iframe-class-resize").css({ width : innerWidth, height : innerHeight })
// })

/**
 * заполняет селектор заявок с главной
 */
function fillRequestSelect() {
	$.getJSON( "/request/getAll", function( data ) {
		let select = $('#requestList');
		select.text('');

		$.each(data, function (index, currentObject) {
			var option = new Option();
			$(option).html(currentObject.id+ '. '+ currentObject.name);
			$(option).val(currentObject.id);
			$(option).attr('data-subtext', currentObject.customer+' '+currentObject.city+' '+ currentObject.equipment);
			select.append(option);
		})
		$('select#requestList').selectpicker("refresh");

	});
}





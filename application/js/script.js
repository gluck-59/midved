$(document).on('ready', function (){
	console.warn('стр загружена');

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


	// отправка приход-расход
	$('#calculate').on('click', function (event) {
		var prihodRashodModal = $('#modalPrihodRashod');
		let sum = $(prihodRashodModal).find('#sum').val();
		if (sum == '') return;
		let requestId =  $(prihodRashodModal).find('#requestId').val();
		let type =  $(prihodRashodModal).find('#type').val();
		let direction =  $(prihodRashodModal).find('#direction').val();
		let note =  $(prihodRashodModal).find('#notes').val();
		console.log('отправка', requestId, type, direction, sum, note)

		sendData = {
			'requestId': requestId,
			'type': type,
			'direction': direction,
			'sum': sum,
			'note': note
		};
		$.post('/request/payment/', sendData, function (data) {
			console.log('POST /request/payment', data);
			if (data == 'true') location.reload();
		})
	});



	// редактирование приход-расход
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
	// /редактирование приход-расход


	// удаление приход-расход
	$('.deletePayment').on('click', function (event) {
		if (!confirm('Удалить строку?')) return;
		$.post('/payment/delete', {'id': event.currentTarget.id}, function (data) {
			// console.log('POST /payment/delete', data);
			if (data == 'true') location.reload();
		})
	} )



	// новая заявка
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



	// сохранение заметок
	$('#notes').on('blur', function (event) {
console.log('textarea', event.currentTarget.dataset.requestId, $(event.currentTarget).val());
		let sendData = {
			'requestId': event.currentTarget.dataset.requestId,
			'notes': $(event.currentTarget).val()
		};
		$.post('/request/setNotes/', sendData, function (data) {
			console.log(data)
		})
	})

}) // document ready

// календарь во весь экран
$("#ical").on('load', function (){
	$("#ical").removeClass("iframe-class-resize").css({ width : innerWidth, height : innerHeight })
})

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

	// отправка приход-расходы
	$('#calculate').on('click', function (event) {
		var prihodRashodModal = $('#modalPrihodRashod');
		let sum = $(prihodRashodModal).find('#sum').val();
		if (sum == '') return;
		let requestId =  $(prihodRashodModal).find('#requestId').val();
		let type =  $(prihodRashodModal).find('#type').val();
		let direction =  $(prihodRashodModal).find('#direction').val();
		console.log('отправка', requestId, type, direction, sum)

		sendData = {
			'requestId': requestId,
			'type': type,
			'direction': direction,
			'sum': sum
		};
		$.post('/request/payment/', sendData, function (data) {
			console.log('POST /request/payment', data);
			if (data == 'true') location.reload();

		})

	})

})

// календарь во весь экран
$("#ical").on('load', function (){
	$("#ical").removeClass("iframe-class-resize").css({ width : innerWidth, height : innerHeight })
})

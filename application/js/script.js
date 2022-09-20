$(document).on('ready', function (){
	console.warn('стр загружена');

	// кнопки +/- расходов и платежей
	$('.paymentEdit').on('click', function (event){
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
	})

})

// календарь во весь экран
$("#ical").on('load', function (){
	$("#ical").removeClass("iframe-class-resize").css({ width : innerWidth, height : innerHeight })
})

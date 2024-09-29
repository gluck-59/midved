$(document).on('ready', function (){
	/**
	 * создает приход-расход или авторазноску (определяется по currentModalId)
 	 */
	$('.calculate').on('click', function (event) {
		var prihodRashodModal = $(currentModalId);
		let sum = $(prihodRashodModal).find('.sum').val();

		let requestId =  $(prihodRashodModal).find('#requestId').val() || $('#requestList').val();
		let customerId =  $(prihodRashodModal).find('#customerList').val() || $('#customerList').val();
		let type =  $(prihodRashodModal).find('#typePayment').val() || prihodRashodModal.find('#paymentType').prop('checked');
		let direction =  $(prihodRashodModal).find('#direction').val();
		let note =  $(prihodRashodModal).find('#notes').val();

// console.log('отправка:', 'requestId:', requestId, 'customerId:', customerId, 'type:	', type, 'direction:', direction, 'sum:', sum, 'note:', note)

		if (sum == '') {
			toastr.error('Укажите сумму');
			return;
		}
		if (requestId == '' && customerId == '') {
			toastr.error('Укажите Клиента/Заявку');
			return;
		}

		sendData = {
			'requestId': requestId,
			'customerId': customerId,
			'type': (type == 'true' ? 1:0),
			'direction': direction,
			'sum': sum,
			'note': note
		};
		// console.log('sendData', sendData);
		$.post('/request/payment/', sendData, function (data) {
			// console.log('ответ POST /request/payment', JSON.parse(data));
			if (data == 'true') location.reload(); 				// не авторвзноска /*@TODO переписать ответ сервера
			if (currentModalId == '#modalAutoDistribution') { 	// авторазноска
				$('#modalAutoDistributionReport').html(_fillReport(JSON.parse(data)))
			}
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
			console.log('POST /payment/edit', data, typeof data);
			if (data.toastr) {
				showToastr(data.toastr);
				// if (data.toastr.type == 1) window.location.reload();
			}
		}, "json")
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
		if (modal.find('#desc').val() == '') return;
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
			if (data.toastr) {
				showToastr(data.toastr);
			}
		}, "json")
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
			// if (data == 1) window.location.href='/request'; // оригинал
			if (data.toastr) {
				showToastr(data.toastr);
				// if (data.toastr.type == 1) window.location.reload();
			}
		}, "json");
	})




	/**
	 * создает или редактирует клиента
	 */
	$('#saveCustomer').on('click', function (event) {
		let modal = $('.modal#modal-customer');
		if (modal.find('#name').val() == '') return;
		let sendData = {
			'customerId': modal.find('#customerId').val(),
			'parentId': modal.find('[name=customers]').val(),
			'customerName': modal.find('#name').val(),
			'customerData': modal.find('#data').val(),
		};
console.log(sendData.customerId, typeof sendData.customerId)
		if (sendData.customerId != '' && sendData.customerId == sendData.parentId) {
			toastr.error('Клиент не может быть родителем самого себя');
			return;
		}

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
		if (modal.find('#name').val() == '') return;
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




	$('#year').text(new Date().getFullYear());
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
	$.getJSON( "/request/index/true", function( data ) {
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


function showToastr(data) {
	switch (data.type) {
		case 0:
			toastr.error(data.message, data.header);
			break;

		case 1:
			toastr.success(data.message, data.header);
			break;

		case 2:
			toastr.info(data.message, data.header);
			break;
		case 3:
			toastr.waiting(data.message, data.header);
			break;

		default:
			toastr.info(data.message, data.header);
	}
}


/**
 * для авторазноски
 * ловит ответ от сервера и формирует отчет
 *
 * @param object
 * @return string
 */
function _fillReport(object) {
	let out = ['<h3>Отчет</h3>'];
	$.each(object, function (name, item) {
		if (name == 'resultNorm' && item.length > 0) {
			$.each(item, function (name, data) {
				let temp = '<p>На заявку №'+data.requestId+' «<b>'+data.requestName+'</b>» упало '+new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'rub', maximumFractionDigits: 0 }).format((data.notEnough ? data.paymentSum : data.needSum) )+'.</p>';
				if (data.notEnough) {
					temp += '<p>На покрытие заявки не хватило '+new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'rub', maximumFractionDigits: 0 }).format(data.needSum - data.paymentSum)+'.</p>';
				}
				out.push(temp)
			})
		}

		if (name == 'resultOver' ) {
			$.each(item, function (name, data) {
				let temp = '<p>Излишек '+new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'rub', maximumFractionDigits: 0 }).format(data.oversum)+' упал на заявку №'+data.oversumRequestId+' «<b>'+data.oversumRequestName+'</b>»</p>';
				out.push(temp)
			})
		}
	})
	return out;
}

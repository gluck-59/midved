$(document).on('ready', function (){
	// $('select').selectpicker();

})

$('#customer').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
	console.log(clickedIndex)
});


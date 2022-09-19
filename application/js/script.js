$(document).on('ready', function (){
	console.warn('стр загружена');


})

// календарь во весь экран
$("#ical").on('load', function (){
	$("#ical").removeClass("iframe-class-resize").css({ width : innerWidth, height : innerHeight })
})

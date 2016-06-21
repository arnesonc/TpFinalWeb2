function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function mostrarMensaje(nombreDiv, mensaje, autoHide){
  var divMensaje = $("#" + nombreDiv);
  divMensaje.html(mensaje);
  divMensaje.show('fast');

	if(autoHide === true){
		setTimeout(function() { ocultarMensaje(nombreDiv); }, 5000);
	}
}

function ocultarMensaje(nombreDiv){
  $("#" + nombreDiv).hide('fast');
}

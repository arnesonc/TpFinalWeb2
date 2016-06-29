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

function obtenerSessionID(){
	// global param
	var selector = !0;
	// get return ajax object
	var ajaxObj = ajaxSessionID();
	// store ajax response in var
	var ajaxResponse = ajaxObj.responseText;
	// check ajax response
	console.log(ajaxResponse);
	// your ajax callback function for success
	ajaxObj.success(function(response) {
		id_user = response;
	});
	return id_user;
}

function ajaxSessionID() {
	return $.ajax({
		type: "POST",
		url: '/helpers/SessionAjaxHelper.php',
		data: {
		},
		dataType: "html",
		async: !1,
		error: function() {
			alert("No pudo obtener el USER_ID de Session")
		}
	});
}

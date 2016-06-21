$(document).ready(function() {

  $("#btnIniciarSesion").click(function(event){
    ocultarMensajeError();
    event.preventDefault();
    iniciarSesion();
  });
});

function mostrarMensajeError(mensaje){
  var divMensajeError = $("#divMensajeError");
  divMensajeError.html(mensaje);
  divMensajeError.show();
}

function ocultarMensajeError(){
  $("#divMensajeError").hide();
}

function iniciarSesion(){
  var email = $("#email").val().trim();
  var pass = $("#pass").val().trim();

  if(validateEmailPass(email, pass)){
    $.ajax({
			url : '/helpers/UsuarioAjaxHelper.php',
			data : {
				metodo : "checkUserAndPass",
				email : email,
				pass : pass
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {

        if(result === true){
          window.location.href = "../admin-cms.php";
        }else{
          mostrarMensajeError(result);
        }

			},
			error : function(error) {
				alert("Ups, ocurrio un error! ");
			}
		});
  }
}

function validateEmailPass(email, pass){

  if($.trim(email) == "" || $.trim(email).length < 1 || $.trim(email).length > 50){
		mostrarMensajeError("Debe ingresar un email.");
		return false;
	}

	if(!isEmail(email)){
		mostrarMensajeError("El email ingresado no tiene un formato correcto.");
		return false;
	}

	if($.trim(pass) == "" || $.trim(pass).length < 1 || $.trim(pass).length > 50){
		mostrarMensajeError("Debe ingresa una contraseña.");
		return false;
	}

  return true;
}

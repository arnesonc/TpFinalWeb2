$(document).ready(function() {

  $("#btnIniciarSesion").click(function(event){
    ocultarMensaje("divMensajeError");
    event.preventDefault();
    iniciarSesion();
  });
});

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
          mostrarMensaje("divMensajeError", result, true);
        }
			},
			error : function(error) {
				mostrarMensaje("divMensajeError", "Ups, ocurrio un error al loguear! ", true);
			}
		});
  }
}

function validateEmailPass(email, pass){

  if($.trim(email) == "" || $.trim(email).length < 1 || $.trim(email).length > 50){
		mostrarMensaje("divMensajeError", "Debe ingresar un email.");
		return false;
	}

	if(!isEmail(email)){
		mostrarMensaje("divMensajeError", "El email ingresado no tiene un formato correcto.");
		return false;
	}

	if($.trim(pass) == "" || $.trim(pass).length < 1 || $.trim(pass).length > 50){
		mostrarMensaje("divMensajeError", "Debe ingresa una contraseña.");
		return false;
	}

  return true;
}

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
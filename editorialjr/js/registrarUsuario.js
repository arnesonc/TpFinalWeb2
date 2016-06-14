$(document).ready(function() {

	$("#btnAceptar").click(function(event) {
		event.stopPropagation();
		guardarUsuario();
	});

	function guardarUsuario() {

		var email = $("#email").val().trim();
		var pass = $("#pass").val().trim();
		var nombre = $("#nombre").val().trim();
		var apellido = $("#apellido").val().trim();
		if (usuarioValido(email, pass, nombre, apellido)) {
			$.ajax({
				url : '/helpers/UsuarioAjaxHelper.php',
				data : {
					metodo : "createUsuarioParametros",
					email : email,
					pass : pass,
					nombre : nombre,
					apellido : apellido,
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					if ($.isNumeric( result ) ) {
						limpiarFormulario();
						alert("Registracion exitosa.");
					} else {
						alert("error en registracion.");
						alert(result);
					}

				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
			});
		}
	}

	function limpiarFormulario() {
		// TODO: implementar
	}

	function usuarioValido(email, pass, nombre, apellido) {
		// TODO: implementar validaciones

		return true;
	}

});
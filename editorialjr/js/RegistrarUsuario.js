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
					if (result) {
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
 				$("#email").val("");
 				$("#pass").val("");
 				$("#nombre").val("");
 				$("#apellido").val("");
 	}

 			function usuarioValido(email, pass, nombre, apellido) {

 					if($.trim(email) == "" || $.trim(email).length < 1 || $.trim(email).length > 50){
 						alert("El email no es válido. Debe poseer como máximo 50 caracteres.");
 						return false;
 					}

 					if(!isEmail(email)){
 						alert("El email ingresado no tiene un formato correcto.");
 						return false;
 					}

 					if($.trim(pass) == "" || $.trim(pass).length < 1 || $.trim(pass).length > 30){
 						alert("La contraseña no es válida. Debe poseer como máximo 30 caracteres.");
 						return false;
 					}

 					if($.trim(nombre) == "" || $.trim(nombre).length < 1 || $.trim(nombre).length > 30){
 						alert("El nombre no es válido. Debe poseer como máximo 30 caracteres.");
 						return false;
 					}

 					if($.trim(apellido) == "" || $.trim(apellido).length < 1 || $.trim(apellido).length > 30){
 						alert("El apellido no es válido. Debe poseer como máximo 30 caracteres.");
 						return false;
 					}

 					return true;
 				}

 				function isEmail(email) {
 					var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 					return regex.test(email);
 				}
});

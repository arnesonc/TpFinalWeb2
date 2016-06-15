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
		// TODO: implementar
	}

	function usuarioValido(email, pass, nombre, apellido) {
		// TODO: implementar validaciones


			// validar email
			if ( (isset(email)) && email != NULL ){
				var sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
				if(preg_match(sintaxis,email)){
					//error "El email es válido";
					return true;					
					} else {
					//error "El email no es válido";
					return false;					
					}
				} else {
				//error "No completo su email";
				return false;
				}


			// validar nombre
			if ( isset nombre && nombre != NULL ){
				if (strlen(nombre)>50) {
					//error "El nombre tiene mas de 50 caracteres";
					return false;
					} else {
					//error "El nombre tiene maximo de 50 caracteres";

					if (ctype_alpha(nombre)) {
			       		//error "El nombre contiene solo letras.";
			       		return true;
			   		} else {
						//error "El nombre debe contener solo letras";
						return false;
			   			}
					}
				} else {
				//error "No completo su nombre";
				return false;
				}


			// validar apellido
			if ( isset apellido && apellido != NULL ){
				if (strlen(apellido)>50) {
					//error "El apellido tiene mas de 50 caracteres";
					return false;
					} else {
					//error "El apellido tiene maximo de 50 caracteres";
					if (ctype_alpha(apellido)) {
			       		//error "El apellido contiene solo letras.";
			       		return true;
			   		} else {
						//error "El apellido debe contener solo letras";
						return false;
			   			}
					}
				} else {
				//error "No completo su apellido";
				return false;
				}


			// validar pass
			if ( isset pass && pass != NULL ){
				if (strlen(pass)>50) {
					//error "El pass tiene mas de 50 caracteres";
					return false;
					} else {
					//error "El pass tiene maximo de 50 caracteres";
					return true;
				} else {
				//error "No completo su apellido";
				return false;
				}



		return true;
	}

});
$(document).ready(function() {

	$("#btnEnviar").click(function(event) {
		event.stopPropagation();
		enviarPortada();
	});

	function enviarPortada() {
		
		// Toma los valores de la vista para enviarlos por ajax a su helper.
		var id_usuario = 1;// $("#user").val().trim();
		var fichero = $("#fichero");
		
		if (fichero) {
			$.ajax({
				url : '/helpers/NumeroAjaxHelper.php',
				data : {
					metodo : "uploadPortada",
					fichero : fichero,
				},
				type : 'POST',
				dataType : "multipart/form-data",
				success : function(result) {
					if (result) {
						alert("Subida exitosa.");
					} else {
						alert("error en subida.");
						alert(result);
					}

				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
			});
		}
	}
});
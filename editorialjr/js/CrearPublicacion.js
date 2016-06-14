$(document).ready(function() {

	$("#btnCrear").click(function(event) {
		event.stopPropagation();
		crearPublicacion();
	});

	function crearPublicacion() {
		
		// Toma los valores de la vista para enviarlos por ajax a su helper.
		var id_usuario = 1;// $("#user").val().trim();
		var nombre = $("#nombre").val().trim();
		var destacado = $("#destacado").val().trim();
		var url_portada = $("#url_portada").val().trim();
		var precio = $("#precio").val().trim();
		
		if (publicacionValida(id_usuario, nombre, destacado, precio)) {
			$.ajax({
				url : '/helpers/PublicacionAjaxHelper.php',
				data : {
					metodo : "createPublicacionNumero",
					id_usuario : id_usuario,
					nombre : nombre,
					destacado : destacado,
					precio : precio,
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					if ($.isNumeric( result ) ) {
						limpiarFormulario();
						alert("Creacion exitosa.");
					} else {
						alert("error en creacion de publicacion.");
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

	function publicacionValida(id_usuario, nombre, destacado, url_portada, precio) {
		// TODO: implementar validaciones

		return true;
	}

});
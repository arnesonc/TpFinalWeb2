$(document).ready(function() {
	//MASKMONEY
		$("#precio").maskMoney({prefix:'AR$ ', allowNegative: false, thousands:'', decimal:'.', affixesStay: false});

		$("#btnCrear").click(function(event) {
		event.stopPropagation();
		crearPublicacion();
	});

	function crearPublicacion() {

		// Toma los valores de la vista para enviarlos por ajax a su helper.
		var id_usuario = 1;// $("#user").val().trim();
		var nombre = $("#nombre").val().trim();

		if($('#destacado').is(':checked')){
			var destacado = 1;
		}
		else {
			var destacado = 0;
		}

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
					if (result == 1) {
						limpiarFormulario();
						alert("Creacion exitosa.");
					} else {
						console.log("else success");
						alert("error en creacion de publicacion.");
						alert(result);
					}
				},
				error : function(error) {
					console.log("error"+error);
					alert("Upa, ocurrio un error! ");
				}
			});
		}
	}

	function limpiarFormulario() {
		$("#nombre").val("");
		$("#destacado").prop("checked", "");
		$("#precio").val("");
	}

	function publicacionValida(id_usuario, nombre, destacado, precio) {
		// TODO: implementar validaciones

		return true;
	}

});

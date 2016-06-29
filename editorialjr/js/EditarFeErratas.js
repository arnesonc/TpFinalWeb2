$(document).ready(function() {

	$("#btnEnviar").click(function(event) {
		event.stopPropagation();
		editarFeErratas();
	});

});	
	function editarFeErratas(){

		var idNumero = $("#idNumero").val();
		var feErratas = $("#texto").val().trim();
		
		$.ajax({
			url : '/helpers/NumeroAjaxHelper.php',
			data : {
				metodo : "editarFeErratas",
				idNumero : idNumero,
				feErratas : feErratas,
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				if (result == 1) {
					alert("Se publicó la fé de erratas exitosamente.");
					RedirectNumeros(idPublicacion);
				} else {
					alert("Error al publicar la fé de erratas.");
					alert(result);
				}
			},
			error : function(error) {
				console.log("error"+error);
				alert("Weeeepa, ocurrio un error! ");
			}
		});
	}

	
	function RedirectNumeros(idPublicacion){
		$.redirect('admin-listar-numeros.php', {'idPublicacion': idPublicacion});
	}
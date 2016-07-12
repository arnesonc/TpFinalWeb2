function editarArticulo(id_numero,id_articulo,id_user){

	$("#btnGuardar").click(function(){

		$("#lat").val(window.lat);
		$("#lng").val(window.lng);
		$("#idNumero").val(id_numero);
		$("#idArticulo").val(id_articulo);
		$("#idUser").val(id_user);
		$("#contenido").val($('#summernote').summernote('code'));

		/*var fm = $('#myForm');

		var formdata = new FormData(fm[0]);

		for (var key of formdata.keys()){
			alert(key+" "+formdata.get(key));
		}*/
		
		$('#myForm').submit();
	});

	function formEnviar(formdata, fm){
		alert("entro");

		$.ajax({
			url         : '/helpers/ArticuloAjaxHelper.php',
			data        : formdata ? formdata : fm.serialize(),
			cache       : false,
			contentType : false,
			processData : false,
			type        : 'POST',
			success     : function(data, textStatus, jqXHR){
				alert(data);
				// Callback code
			},
			error       : function(error){
				alert("error en el ajax!");
			} 

		});
	}
}

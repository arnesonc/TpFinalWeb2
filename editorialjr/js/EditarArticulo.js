function editarArticulo(id_numero,id_articulo,id_user){
	
	$("#btnGuardar").click(function(){

		$("#lat").val(window.lat);
		$("#lng").val(window.lng);
		$("#idNumero").val(id_numero);
		$("#idArticulo").val(id_articulo);
		$("#idUser").val(id_user);
		$("#contenido").val($('#summernote').summernote('code'));


		$( "#myForm" ).submit();

	});
	
}
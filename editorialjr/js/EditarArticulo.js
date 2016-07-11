function editarArticulo(id_numero,id_articulo,id_user){

	$("#btnGuardar").click(function(){

		$("#lat").val(window.lat);
		$("#lng").val(window.lng);
		$("#idNumero").val(id_numero);
		$("#idArticulo").val(id_articulo);
		$("#idUser").val(id_user);
		$("#contenido").val($('#summernote').summernote('code'));

		alert("guardar");

		$("#myForm").submit();
	});

	$('#myForm').on('sumbit', function(){
		var form = $(this);
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}

		$.ajax({
			url         : '/helpers/ArticuloAjaxHelper.php',
			data        : formdata ? formdata : form.serialize(),
			cache       : false,
			contentType : false,
			processData : false,
			type        : 'POST',
			success     : function(data, textStatus, jqXHR){
				alert(data);
				// Callback code
			}
		});
	});

}

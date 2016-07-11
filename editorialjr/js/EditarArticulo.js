function editarArticulo(id_numero,id_articulo,id_user){
	
	//alert('el id del numero es '+ id_numero +' el id del articulo es '+ id_articulo + ' el id del usuario es '+ id_user);

	$("#btnGuardar").click(function(){
    	var markupStr = $('#summernote').summernote('code');
    	alert(markupStr);
	});
	
}
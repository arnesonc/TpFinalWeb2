function getAllNumeros(id_publicacion) {
			var idPublicacion = id_publicacion;

			$.ajax({
				url : '/helpers/NumeroAjaxHelper.php',
				data : {
					metodo : "getAllNumeros",
					idPublicacion : idPublicacion
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					
					/* Arma el html de resultado iterando en los items */
					var html = "<div class='numeros'>";

					/*
					 * Itera el resultado (igual que en PHP, hay un array
					 * que se llama result y una variable para el indice y
					 * otra para el valor) Para usar un objeto json basta
					 * con objeto.atributo. Ej: ciudad.descripcion
					 */
					$.each(result, function(index, numero) {

						html += "<a value='" + numero.numero_revista + "'>"+"numero: "+numero.numero_revista + "  precio: "+ numero.precio + "</a>"
						+"<button type ="+'button'+" onclick='editarNumeroFormulario("+ numero.id +")'>editar numero</button>" //boton que muestra el formulario (el formulario no usa ajax)
						+"<button type ="+'button'+" onclick='getAllArticulos("+ numero.id +")'>Listar Articulos</button>"
						+"<br>";
						
					});

					html += "</div>";
					
					/* Aca se renderiza el resultado obtenido */
					$("#divListaNumeros").html(html);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});	
}

//escondemos el formulario que solo se activara cuando hagamos click en editar.
$("#formularioDeEdicion").hide();
//Cuando queremos editar un numero, el formulario debe conocer el id del numero contra el cual hacer los cambios
//Pasaremos el id en el mismo formulario, tomandolo desde el parametro de la funcion.
function editarNumeroFormulario(id_numero){
	var id = id_numero;
	$("#formularioDeEdicion").show();
	$("#idNumero").val(id_numero);
}


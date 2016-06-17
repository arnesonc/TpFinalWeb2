function getAllArticulos(id_numero) {
		$.ajax({
				url : '/helpers/ArticuloAjaxHelper.php',
				data : {
					metodo : "getAllArticulos",
					id_numero : id_numero,
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					
					/* Arma el html de resultado iterando en los items */
					var html = "<div class='articulos'>";

					/*
					 * Itera el resultado (igual que en PHP, hay un array
					 * que se llama result y una variable para el indice y
					 * otra para el valor) Para usar un objeto json basta
					 * con objeto.atributo. Ej: ciudad.descripcion
					 */
					$.each(result, function(index, articulo) {
						//cada link dispara a la funcion que obtiene todos los numeros para dicha publicacion.
						html += "<a id= '"+ articulo.id +"'value='" + articulo.titulo + "'>"+"articulo: "+ articulo.titulo
						+"<br>";						
					
					});

					html += "</div>";
					
					/* Aca se renderiza el resultado obtenido */
					$("#divListaArticulos").html(html);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});	
}
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
						+"<button type ="+'button'+" onclick='getAllNumeros("+ publicacion.id +")'>editar numero</button>"
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


function getAllPublicaciones() {
						$.ajax({
				url : '/helpers/PublicacionAjaxHelper.php',
				data : {
					metodo : "getAllPublicaciones",
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					
					/* Arma el html de resultado iterando en los items */
					var html = "<div class='publicacion'>";

					/*
					 * Itera el resultado (igual que en PHP, hay un array
					 * que se llama result y una variable para el indice y
					 * otra para el valor) Para usar un objeto json basta
					 * con objeto.atributo. Ej: ciudad.descripcion
					 */
					$.each(result, function(index, publicacion) {
						//cada link dispara a la funcion que obtiene todos los numeros para dicha publicacion.
						html += "<a id= '"+ publicacion.id +"'value='" + publicacion.nombre + "'>"+"publicacion: "+ publicacion.nombre + "</a>"+
						"<button type ="+'button'+" onclick='getAllNumeros("+ publicacion.id +")'>obtener numeros</button>" + 
						"<br>";						
					
					});

					html += "</div>";
					
					/* Aca se renderiza el resultado obtenido */
					$("#divListaPublicaciones").html(html);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});	
}
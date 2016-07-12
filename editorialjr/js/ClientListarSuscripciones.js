
$(document).ready(function(){
	obtenerPublicacionesByIdUser();
});

function obtenerPublicacionesByIdUser() {
		$.ajax({
				url : '/helpers/PublicacionAjaxHelper.php',
				data : {
					metodo : "obtenerPublicacionesByIdUser",
					idCliente : obtenerSessionID(),
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					armarTablaPublicaciones(result);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});

		function armarTablaPublicaciones(listaPublicaciones){

			  var tabla = "";
			  $("#bodyPublicaciones").html("");

			  tabla = "<table id='tblPublicaciones' class='table table-striped table-bordered table-responsive' cellspacing='0'>";
			  tabla +="<thead><tr><th>Publicacion</th><th>Destacada</th><th>Fecha ultima publicacion</th>";
			  tabla +="<th>Acciones</th></tr></thead><tbody>";

			  $.each(listaPublicaciones, function(index, publicacion) {
				  destacado=(publicacion.destacado == 1)?'si':'no';
				  tabla += "<tr><td>" + publicacion.nombre + "</td><td>" + destacado + "</td><td>" + publicacion.fecha_utlimo_numero + "</td>";
				  tabla += "<td><button onclick='aNumeros("+ publicacion.id +");' id='btnListarNumeros' name='" + publicacion.id + "' class='btn btn-success'><span class='glyphicon glyphicon-list'></span> Ver Números</button> </td></tr> ";

			  });

			  tabla += "</td></tr></tbody></table>";

			  var tblPublicaciones = $("#tblPublicaciones");

			  if(tblPublicaciones){
				  tblPublicaciones.dataTable().fnDestroy();
			  }

			  $("#divTablaPublicaciones").html(tabla);

			  $("#tblPublicaciones").dataTable({
			      "language": {
			          "url": "../js/datatables.spanish.lang"
			      }
			  });
			}
}

function aNumeros(idPublicacion){
	$.redirect('client-listar-numeros.php', {'idPublicacion': idPublicacion});
}

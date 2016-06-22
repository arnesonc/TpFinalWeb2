
$(document).ready(function(){

	getAllPublicaciones();

});

function getAllPublicaciones() {
		$.ajax({
				url : '/helpers/PublicacionAjaxHelper.php',
				data : {
					metodo : "getAllPublicaciones",
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
			  tabla +="<thead><tr><th>Publicacion</th><th>Destacada</th>";
			  tabla +="<th>Acciones</th></tr></thead><tbody>";

			  $.each(listaPublicaciones, function(index, publicacion) {
				  destacado=(publicacion.destacado == 1)?'si':'no';
				  tabla += "<tr><td>" + publicacion.nombre + "</td><td>" + destacado + "</td>";
				  tabla += "<td><button id='btnEditarPublicacion' name='editarPublicacion' class='btn btn-primary' onclick='editarPublicacion(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";
				  tabla += "<a href='/ListarNumeros.php?id="+publicacion.id + "'id='btnListarNumeros' name='" + publicacion.id +"' class='btn btn-info'><span class='glyphicon glyphicon-list'></span> Ver Números</a> </td></tr> ";
			   
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

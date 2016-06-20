function listarArticulos(id_numero) {
		$.ajax({
				url : '/helpers/ArticuloAjaxHelper.php',
				data : {
					metodo : "getAllArticulos",
					id_numero : id_numero,
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					armarTablaArticulos(result);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});	
}

function armarTablaArticulos(listaArticulos){

	  var tabla = "";
	  $("#bodyArticulos").html("");
	  
	  tabla = "<table id='tblArticulos' class='table table-striped table-bordered table-responsive' cellspacing='0'>";
	  tabla +="<thead><tr><th>Titulo</th><th>fecha cierre</th>";
	  tabla +="<th>Acciones</th></tr></thead><tbody>";

	  $.each(listaArticulos, function(index, articulo) {
	    tabla += "<tr><td>" + articulo.titulo + "</td>";
	    tabla += "<td>" + articulo.fecha_cierre + "</td>";
	    tabla += "<td><button id='btnEditarArticulo' name='' class='btn btn-primary' onclick='editarArticulo(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";
	    tabla += "<a href='/views/ListarArticulos.php?id="+articulo.id + "'id='btnListarArticulos' name='" + articulo.id +"' class='btn btn-info'><span class='glyphicon glyphicon-list'></span>Ver este articulo</a></td></tr> ";
		});
	  

	  tabla += "</td></tr></tbody></table>";

	  var tblArticulos = $("#tblArticulos");

	  if(tblArticulos){
		  tblArticulos.dataTable().fnDestroy();
	  }

	  $("#divTablaArticulos").html(tabla);

	  $("#tblArticulos").dataTable({
	      "language": {
	          "url": "../js/datatables.spanish.lang"
	      }
	  });
	}
function listarNumeros(id_publicacion) {
			var idPublicacion = id_publicacion;

			$.ajax({
				url : '/helpers/NumeroAjaxHelper.php',
				data : {
					metodo : "getNumerosPorSuscripcion",
					idPublicacion : idPublicacion,
					idCliente : obtenerSessionID()
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					armarTablaNumeros(result);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});
}

function armarTablaNumeros(listaNumeros){

	  var tabla = "";
	  $("#bodyNumeros").html("");

	  tabla = "<table id='tblNumeros' class='table table-striped table-bordered table-responsive' cellspacing='0'>";
	  tabla +="<thead><tr><th>Numero</th><th>fecha publicado</th>";
	  tabla +="<th>Acciones</th></tr></thead><tbody>";

	  $.each(listaNumeros, function(index, numero) {
		fecha=(numero.fecha_publicado == null) ? '<strong>DRAFT</strong>' : numero.fecha_publicado;
		tabla += "<tr><td>" + numero.numero_revista + "</td>";
	    tabla += "<td>" + fecha + "</td>";
		tabla += "<td><button onclick='RedirectArticulos("+ numero.id +","+ numero.id_estado_numero +");' id='btnListarArticulos' name='" + numero.id + "' class='btn btn-success'><span class='glyphicon glyphicon-list'></span> Ver Articulos</button>  ";
		tabla += "<button onclick='RedirectArticulos("+ numero.id +","+ numero.id_estado_numero +");' id='btnListarArticulos' name='" + numero.id + "' class='btn btn-warning'><span class='glyphicon glyphicon-list'></span> Descargar en PDF</button>  ";
		});


	  tabla += "</td></tr></tbody></table>";

	  var tblNumeros = $("#tblNumeros");

	  if(tblNumeros){
		  tblNumeros.dataTable().fnDestroy();
	  }

	  $("#divTablaNumeros").html(tabla);

	  $("#tblNumeros").dataTable({
	      "language": {
	          "url": "../js/datatables.spanish.lang"
	      }
	  });
	}

function RedirectArticulos(idNumero,estadoNumero){
	$.redirect('admin-listar-articulos.php', {'idNumero': idNumero, 'estadoNumero': estadoNumero});
}

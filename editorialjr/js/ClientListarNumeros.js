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
					armarTablaNumeros(result,false);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});
}

function listarNumerosComprados() {
			$.ajax({
				url : '/helpers/NumeroAjaxHelper.php',
				data : {
					metodo : "listarNumerosComprados",
					idCliente : obtenerSessionID()
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					armarTablaNumeros(result,true);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});
}

function armarTablaNumeros(listaNumeros,campoFechaDeCompra){

	  var tabla = "";
	  $("#bodyNumeros").html("");

	  tabla = "<table id='tblNumeros' class='table table-striped table-bordered table-responsive' cellspacing='0'>";
	  tabla +="<thead><tr><th>Publicacion</th><th>Numero</th><th>publicado el dia</th>";
		if(campoFechaDeCompra){tabla += "<th>fecha compra</th>";}
		tabla +="<th>Acciones</th></tr></thead><tbody>";

	  $.each(listaNumeros, function(index, numero) {
		tabla += "<tr><td>" + numero.nombre_publicacion + "</td><td>" + numero.numero_revista + "</td>";
	  tabla += "<td>" + numero.fecha_publicado + "</td>";
		if(campoFechaDeCompra){tabla += "<td>" + numero.fecha_de_compra + "</td>";}
		tabla += "<td><button onclick='RedirectArticulos("+ numero.id +");' id='btnListarArticulos' name='" + numero.id + "' class='btn btn-success'><span class='glyphicon glyphicon-list'></span> Ver Articulos</button>  ";
		tabla += "<button onclick='RedirectArticulos("+ numero.id +");' id='btnListarArticulos' name='" + numero.id + "' class='btn btn-warning'><span class='glyphicon glyphicon-list'></span> Descargar en PDF</button>  ";

		if(numero.fe_erratas != null){
			tabla += "<button onclick='verFeErratas("+ numero.id +");' id='btnVerFeErratas' name='" + numero.id + "' class='btn btn-info'><span class='glyphicon glyphicon-info-sign'></span> Cometimos errores ( leer )</button>  ";
		}
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

function verFeErratas(idNumero){
	$.ajax({
		url : '/helpers/NumeroAjaxHelper.php',
		data : {
			metodo : "traerFeErratas",
			idNumero : idNumero
		},
		type : 'POST',
		dataType : "json",
		success : function(result) {
			alert(result);
		},
		error : function(error) {
			alert("Ups, ocurrio un error! " + error);
		}
});
}

function RedirectArticulos(idNumero){
	$.redirect('client-listar-articulos.php', {'idnum': idNumero});
}

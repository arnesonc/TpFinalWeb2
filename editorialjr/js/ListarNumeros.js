function listarNumeros(id_publicacion) {
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
	  tabla +="<thead><tr><th>Numero</th><th>Precio</th><th>fecha publicado</th>";
	  tabla +="<th>Acciones</th></tr></thead><tbody>";

	  $.each(listaNumeros, function(index, numero) {
		fecha=(numero.fecha_publicado == null) ? '<strong>DRAFT</strong>' : numero.fecha_publicado;
		tabla += "<tr><td>" + numero.numero_revista + "</td>";
	    tabla += "<td>AR$ " + numero.precio + "</td>";
	    tabla += "<td>" + fecha + "</td>";
		tabla += "<td><button onclick='RedirectArticulos("+ numero.id +","+ numero.id_estado_numero +");' id='btnListarArticulos' name='" + numero.id + "' class='btn btn-info'><span class='glyphicon glyphicon-list'></span> Ver Articulos</button>  ";
		//Si esta en draft, coloca publicar u editar, sino coloca fe de erratas.
			if(numero.fecha_publicado == null){
				tabla += "<button id='btnEditarNumero' name='"+ numero.id +"' class='btn btn-primary' onclick='editarNumero(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";
				tabla += "<button onclick='publicar("+ numero.id +","+ numero.id_estado_numero +");' id='btnPublicar' name='" + numero.id + "' class='btn btn-success'><span class='glyphicon glyphicon-share'></span> Publicar</button> </td></tr> ";
			} else {
				if(numero.fe_erratas == null){ 
					tabla += "<button onclick='addFeErratas("+ numero.id +","+ numero.id_estado_numero +");' id='btnFeErratas' name='" + numero.id + "' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span> Nueva Fe De Erratas</button> </td></tr> ";		
				} else {
					tabla += "</td></tr>";
				}
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
/*
//escondemos el formulario que solo se activara cuando hagamos click en editar.
$("#formularioDeEdicion").hide();
//Cuando queremos editar un numero, el formulario debe conocer el id del numero contra el cual hacer los cambios
//Pasaremos el id en el mismo formulario, tomandolo desde el parametro de la funcion.
function editarNumeroFormulario(id_numero){
	var id = id_numero;
	$("#formularioDeEdicion").show();
	$("#idNumero").val(id_numero);
}
*/
function editarNumero(button){
	$("#idNumero").val(button.name);
	$("#divMensajeError").hide();  
	$("#modalNumero").modal('show');
}

function RedirectArticulos(idNumero,estadoNumero){

	$.redirect('admin-listar-articulos.php', {'idNumero': idNumero, 'estadoNumero': estadoNumero});
}
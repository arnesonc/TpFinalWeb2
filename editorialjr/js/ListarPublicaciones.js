
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
				  tabla += "<td><button id='btnEditarPublicacion' name='"+ publicacion.id +"' class='btn btn-primary' onclick='editarPublicacion(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";
				  tabla += "<button onclick='aNumeros("+ publicacion.id +");' id='btnListarNumeros' name='" + publicacion.id + "' class='btn btn-info'><span class='glyphicon glyphicon-list'></span> Ver Números</button> </td></tr> ";
			   
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
	$.redirect('admin-listar-numeros.php', {'idPublicacion': idPublicacion});
}


function editarPublicacion(botonEditar){

	  var idPublicacion = botonEditar.name;
	  $("#hdnIdPublicacion").val(idPublicacion);
	  $("#tituloModalPublicacion").html("Editar Publicacion");

	  $.ajax({
	    url : '/helpers/PublicacionAjaxHelper.php',
	    data : {
			metodo : "getPublicacionById",
			id : idPublicacion,
	    },
	    type : 'POST',
	    dataType : "json",
	    success : function(publicacion) {
	      $("#nombre").val(publicacion.nombre);
	      $("#destacado").val(publicacion.destacado);
	      $("#modalPublicacion").modal('show');
	    },
	    error : function(error) {
	      mostrarMensaje("divError", "Ups, ocurrio un error!", true);
	    }
	  });
	}

function actualizarPublicacion(idPublicacion) {

	var nombre = $("#nombre").val().trim();
	var destacado = null;
	($('#destacado').is(':checked')) ?  destacado = 1 : destacado = 0;
	
	
		$.ajax({
			url : '/helpers/PublicacionAjaxHelper.php',
			data : {
				metodo : "updatePublicacionParameters",
				idPublicacion : idPublicacion,
				nombre : nombre,
				destacado : destacado,
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				if (result) {
			          $("#modalPublicacion").modal('hide');
			          getAllPublicaciones();
			          mostrarMensaje("divExito", "Actualización exitosa.", true);
				} else {
			          mostrarMensaje("divError", "No se pudo actualizar.", true);
				}
			},
			error : function(error) {
				mostrarMensaje("divError", "Ups, ocurrio un error!", true);
			}
		});
}

$("#btnAceptar").click(function(){

    var hdnIdPublicacion = $("#hdnIdPublicacion").val();
    var idPublicacion = hdnIdPublicacion == 0 ? null : hdnIdPublicacion;
      actualizarPublicacion(idPublicacion);
  });
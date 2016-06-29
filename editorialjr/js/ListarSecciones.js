$(document).ready(function(){

  obtenerSecciones();

  $("#btnNuevaSeccion").click(function(){
    nuevaSeccion();
  });

  $("#btnAceptar").click(function(){

    var hdnIdSeccion = $("#hdnIdSeccion").val();
    var idSeccion = hdnIdSeccion == 0 ? null : hdnIdSeccion;

    if(idSeccion == null){
      insertarSeccion();
    }else {
      actualizarSeccion(idSeccion);
    }
  });
});

function nuevaSeccion(){
  $("#divMensajeError").hide();
  $("#tituloModalSeccion").html("Nueva sección");
  $("#hdnIdSeccion").val(0);

  limpiarFormulario();
  $("#modalSeccion").modal('show');
}

function armarTablaSecciones(listaSecciones){

  var tabla = "";
  $("#bodySecciones").html("");

  tabla = "<table id='tblSecciones' class='table table-responsive table-bordered' cellspacing='0'>";
  tabla +="<thead><tr><th>Nombre</th><th>Acciones</th></tr></thead><tbody>";

  $.each(listaSecciones, function(index, seccion) {
    tabla += "<tr><td>" + seccion.nombre + "</td>";
    tabla += "<td><button id='btnEditarSeccion' name='" + seccion.id +"' class='btn btn-primary' onclick='editarSeccion(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";
  });

  tabla += "</td></tr></tbody></table>";

  var tblSecciones = $("#tblSecciones");

  if(tblSecciones){
    tblSecciones.dataTable().fnDestroy();
  }

  $("#divTablaSecciones").html(tabla);

  $("#tblSecciones").dataTable({
    "language": {
      "url": "../js/datatables.spanish.lang"
    }
  });
}

function editarSeccion(botonEditar){

  $("#divMensajeError").hide();

  var idSeccion = botonEditar.name;
  $("#hdnIdSeccion").val(idSeccion);
  $("#tituloModalSeccion").html("Editar sección");

  $.ajax({
    url : '/helpers/SeccionAjaxHelper.php',
    data : {
      metodo : 'getSeccionById',
      idSeccion : idSeccion
    },
    type : 'POST',
    dataType : "json",
    success : function(seccion) {
      $("#nombre").val(seccion.nombre);
      $("#modalSeccion").modal('show');
    },
    error : function(error) {
      mostrarMensaje("divError", "Ups, ocurrio un error!", true);
    }
  });
}

function obtenerSecciones(){
  $.ajax({
    url : '/helpers/SeccionAjaxHelper.php',
    data : {
      metodo : "getAllSecciones"
    },
    type : 'POST',
    dataType : "json",
    success : function(result) {
      if (result != null) {
        armarTablaSecciones(result);
      } else {
        mostrarMensaje("divError", result, true);
      }
    },
    error : function(error) {
      mostrarMensaje("divError", "Ups, ocurrio un error!", true);
    }
  });
}

function seccionValida(nombre, isInsert) {

	if($.trim(nombre) == "" || $.trim(nombre).length < 1 || $.trim(nombre).length > 50){
		mostrarMensaje("divMensajeError", "El nombre no es válido. Debe poseer como máximo 50 caracteres.");
		return false;
	}

	return true;
}

function insertarSeccion() {
	var nombre = $("#nombre").val().trim();

	if (seccionValida(nombre, true)) {
		$.ajax({
			url : '/helpers/SeccionAjaxHelper.php',
			data : {
				metodo : "createSeccionParametros",
				nombre : nombre
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				if (result) {
					limpiarFormulario();
          $("#modalSeccion").modal('hide');
          obtenerSecciones();
          mostrarMensaje("divExito", "Creación exitosa.", true);
				} else {
					mostrarMensaje("divError", "Error al crear la sección.", true);
				}
			},
			error : function(error) {
        mostrarMensaje("divError", "Ups, ocurrio un error!", true);
			}
		});
	}
}

function actualizarSeccion(idSeccion) {

	var nombre = $("#nombre").val().trim();

	if (seccionValida(nombre, false)) {
		$.ajax({
			url : '/helpers/SeccionAjaxHelper.php',
			data : {
				metodo : "updateSeccion",
        idSeccion: idSeccion,
				nombre : nombre
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				if (result) {
          $("#modalSeccion").modal('hide');
          obtenerSecciones();
          mostrarMensaje("divExito", "Actualización exitosa.", true);
				} else {
          mostrarMensaje("divError", "No se pudo actualizar la sección.", true);
				}
			},
			error : function(error) {
				mostrarMensaje("divError", "Ups, ocurrio un error!", true);
			}
		});
	}
}

function limpiarFormulario() {
	$("#nombre").val("");
}

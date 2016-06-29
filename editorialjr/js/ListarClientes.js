$(document).ready(function(){

  obtenerClientes();

  $("#btnNuevoCliente").click(function(){
    nuevoCliente();
  });

  $("#btnAceptar").click(function(){

    var hdnIdCliente = $("#hdnIdCliente").val();
    var idCliente = hdnIdCliente == 0 ? null : hdnIdCliente;

    if(idCliente == null){
      insertarCliente();
    }else {
      actualizarCliente(idCliente);
    }
  });
});

function nuevoCliente(){
  $("#divPassCliente").show();
  $("#divEmailCliente").show();
  $("#tituloModalCliente").html("Nuevo Cliente");
  $("#hdnIdCliente").val(0);

  limpiarFormulario();
  $("#modalCliente").modal('show');
}

function armarTablaClientes(listaClientes){

  var tabla = "";
  $("#bodyClientes").html("");

  tabla = "<table id='tblClientes' class='table table-striped table-bordered' cellspacing='0'>";
  tabla +="<thead><tr><th>Email</th><th>Nombre</th><th>Apellido</th><th>Estado</th>";
  tabla +="<th>Acciones</th></tr></thead><tbody>";

  $.each(listaClientes, function(index, Cliente) {
    tabla += "<tr><td>" + Cliente.email + "</td>";
    tabla += "<td>" + Cliente.nombre + "</td>";
    tabla += "<td>" + Cliente.apellido + "</td>";
    tabla += "<td>" + Cliente.descripcion_estado_cliente + "</td>";
    tabla += "<td><button id='btnEditarCliente' name='" + Cliente.id +"' class='btn btn-primary' onclick='editarCliente(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";

    if(Cliente.id_estado_Cliente == 1){
      tabla += "<button id='btnDesactivarCliente' name='"+ Cliente.id + "' class='btn btn-warning' onclick='deshabilitarCliente(this);'><span class='glyphicon glyphicon-remove'></span> Desactivar</button>";
    }else{
      tabla += "<button id='btnDesactivarCliente' name='"+ Cliente.id + "' class='btn btn-success' onclick='habilitarCliente(this);'><span class='glyphicon glyphicon-ok'></span> Activar</button>";
    }
  });

  tabla += "</td></tr></tbody></table>";

  var tblClientes = $("#tblClientes");

  if(tblClientes){
    tblClientes.dataTable().fnDestroy();
  }

  $("#divTablaClientes").html(tabla);

  $("#tblClientes").dataTable({
    "language": {
      "url": "../js/datatables.spanish.lang"
    }
  });
}

function editarCliente(botonEditar){

  $("#divPassCliente").hide();
  $("#divEmailCliente").hide();

  var idCliente = botonEditar.name;
  $("#hdnIdCliente").val(idCliente);
  $("#tituloModalCliente").html("Editar Cliente");

  $.ajax({
    url : '/helpers/ClienteAjaxHelper.php',
    data : {
      metodo : 'getClienteById',
      idCliente : idCliente
    },
    type : 'POST',
    dataType : "json",
    success : function(Cliente) {
      $("#email").val(Cliente.email);
      $("#nombre").val(Cliente.nombre);
      $("#apellido").val(Cliente.apellido);
      $("#modalCliente").modal('show');
    },
    error : function(error) {
      alert("Ups, ocurrio un error! ");
    }
  });
}

function ejecutarCambioEstado(idCliente, accion){
  $.ajax({
    url : '/helpers/ClienteAjaxHelper.php',
    data : {
      metodo : accion,
      idCliente : idCliente
    },
    type : 'POST',
    dataType : "json",
    success : function(result) {
      if (result === true) {

        obtenerClientes();
      } else {
        alert(result);
      }
    },
    error : function(error) {
      alert("Ups, ocurrio un error! ");
    }
  });
}

function obtenerClientes(){
  $.ajax({
    url : '/helpers/ClienteAjaxHelper.php',
    data : {
      metodo : "getAllClientes"
    },
    type : 'POST',
    dataType : "json",
    success : function(result) {
      if (result != null) {
        armarTablaClientes(result);
      } else {
        alert(result);
      }
    },
    error : function(error) {
      alert("Ups, ocurrio un error!");
    }
  });
}

function deshabilitarCliente(button){
  ejecutarCambioEstado(button.name, 'disableCliente');
}

function habilitarCliente(button){
  ejecutarCambioEstado(button.name, 'enableCliente');
}

function ClienteValido(email, pass, nombre, apellido, isInsert) {

	if(isInsert && ($.trim(email) == "" || $.trim(email).length < 1 || $.trim(email).length > 50)){
		alert("El email no es válido. Debe poseer como máximo 50 caracteres.");
		return false;
	}

	if(isInsert && (!isEmail(email))){
		alert("El email ingresado no tiene un formato correcto.");
		return false;
	}

	if(isInsert && ($.trim(pass) == "" || $.trim(pass).length < 1 || $.trim(pass).length > 30)){
		alert("La contraseña no es válida. Debe poseer como máximo 30 caracteres.");
		return false;
	}

	if($.trim(nombre) == "" || $.trim(nombre).length < 1 || $.trim(nombre).length > 30){
		alert("El nombre no es válido. Debe poseer como máximo 30 caracteres.");
		return false;
	}

	if($.trim(apellido) == "" || $.trim(apellido).length < 1 || $.trim(apellido).length > 30){
		alert("El apellido no es válido. Debe poseer como máximo 30 caracteres.");
		return false;
	}

	return true;
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function insertarCliente() {

	var email = $("#email").val().trim();
	var pass = $("#pass").val().trim();
	var nombre = $("#nombre").val().trim();
	var apellido = $("#apellido").val().trim();

	if (ClienteValido(email, pass, nombre, apellido, true)) {
		$.ajax({
			url : '/helpers/ClienteAjaxHelper.php',
			data : {
				metodo : "createClienteParametros",
				email : email,
				pass : pass,
				nombre : nombre,
				apellido : apellido
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				if (result) {
					limpiarFormulario();
          $("#modalCliente").modal('hide');
          obtenerClientes();
          alert("Registracion exitosa.");
				} else {
					alert("Error en registracion.");
					alert(result);
				}
			},
			error : function(error) {
				alert("Ups, ocurrio un error! ");
			}
		});
	}
}

function actualizarCliente(idCliente) {

	var nombre = $("#nombre").val().trim();
	var apellido = $("#apellido").val().trim();

	if (ClienteValido(email, pass, nombre, apellido, false)) {
		$.ajax({
			url : '/helpers/ClienteAjaxHelper.php',
			data : {
				metodo : "updateClienteParameters",
        idCliente: idCliente,
				nombre : nombre,
				apellido : apellido
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				if (result) {
          $("#modalCliente").modal('hide');
          obtenerClientes();
          alert("Actualización exitosa.");
				} else {
					alert(result);
				}
			},
			error : function(error) {
				alert("Ups, ocurrio un error! ");
			}
		});
	}
}

function limpiarFormulario() {
	$("#email").val("");
	$("#pass").val("");
	$("#nombre").val("");
	$("#apellido").val("");
}

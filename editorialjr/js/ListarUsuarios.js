$(document).ready(function(){

  obtenerUsuarios();

  $("#btnNuevoUsuario").click(function(){
    nuevoUsuario();
  });

  $("#btnAceptar").click(function(){

    var hdnIdUsuario = $("#hdnIdUsuario").val();
    var idUsuario = hdnIdUsuario == 0 ? null : hdnIdUsuario;

    if(idUsuario == null){
      insertarUsuario();
    }else {
      actualizarUsuario(idUsuario);
    }
  });
});

function nuevoUsuario(){
  $("#divPassUsuario").show();
  $("#divEmailUsuario").show();
  $("#tituloModalUsuario").html("Nuevo usuario");
  $("#hdnIdUsuario").val(0);

  limpiarFormulario();
  $("#modalUsuario").modal('show');
}

function armarTablaUsuarios(listaUsuarios){

  var tabla = "";
  $("#bodyUsuarios").html("");

  tabla = "<table id='tblUsuarios' class='table table-striped table-bordered' cellspacing='0'>";
  tabla +="<thead><tr><th>Email</th><th>Nombre</th><th>Apellido</th><th>Rol</th><th>Estado</th>";
  tabla +="<th>Acciones</th></tr></thead><tbody>";

  $.each(listaUsuarios, function(index, usuario) {
    tabla += "<tr><td>" + usuario.email + "</td>";
    tabla += "<td>" + usuario.nombre + "</td>";
    tabla += "<td>" + usuario.apellido + "</td>";
    tabla += "<td>" + usuario.descripcion_rol + "</td>";
    tabla += "<td>" + usuario.descripcion_estado_usuario + "</td>";
    tabla += "<td><button id='btnEditarUsuario' name='" + usuario.id +"' class='btn btn-primary' onclick='editarUsuario(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";

    if(usuario.id_estado_usuario == 1){
      tabla += "<button id='btnDesactivarUsuario' name='"+ usuario.id + "' class='btn btn-warning' onclick='deshabilitarUsuario(this);'><span class='glyphicon glyphicon-remove'></span> Desactivar</button>";
    }else{
      tabla += "<button id='btnDesactivarUsuario' name='"+ usuario.id + "' class='btn btn-success' onclick='habilitarUsuario(this);'><span class='glyphicon glyphicon-ok'></span> Activar</button>";
    }
  });

  tabla += "</td></tr></tbody></table>";

  var tblUsuarios = $("#tblUsuarios");

  if(tblUsuarios){
    tblUsuarios.dataTable().fnDestroy();
  }

  $("#divTablaUsuarios").html(tabla);

  $("#tblUsuarios").dataTable({
    "language": {
      "url": "../js/datatables.spanish.lang"
    }
  });
}

function editarUsuario(botonEditar){

  $("#divPassUsuario").hide();
  $("#divEmailUsuario").hide();

  var idUsuario = botonEditar.name;
  $("#hdnIdUsuario").val(idUsuario);
  $("#tituloModalUsuario").html("Editar usuario");

  $.ajax({
    url : '/helpers/UsuarioAjaxHelper.php',
    data : {
      metodo : 'getUsuarioById',
      idUsuario : idUsuario
    },
    type : 'POST',
    dataType : "json",
    success : function(usuario) {
      $("#email").val(usuario.email);
      $("#nombre").val(usuario.nombre);
      $("#apellido").val(usuario.apellido);
      $("#modalUsuario").modal('show');
    },
    error : function(error) {
      alert("Ups, ocurrio un error! ");
    }
  });
}

function ejecutarCambioEstado(idUsuario, accion){
  $.ajax({
    url : '/helpers/UsuarioAjaxHelper.php',
    data : {
      metodo : accion,
      idUsuario : idUsuario
    },
    type : 'POST',
    dataType : "json",
    success : function(result) {
      if (result === true) {

        obtenerUsuarios();
      } else {
        alert(result);
      }
    },
    error : function(error) {
      alert("Ups, ocurrio un error! ");
    }
  });
}

function obtenerUsuarios(){
  $.ajax({
    url : '/helpers/UsuarioAjaxHelper.php',
    data : {
      metodo : "getAllUsuarios"
    },
    type : 'POST',
    dataType : "json",
    success : function(result) {
      if (result != null) {
        armarTablaUsuarios(result);
      } else {
        alert(result);
      }
    },
    error : function(error) {
      alert("Ups, ocurrio un error!");
    }
  });
}

function deshabilitarUsuario(button){
  ejecutarCambioEstado(button.name, 'disableUsuario');
}

function habilitarUsuario(button){
  ejecutarCambioEstado(button.name, 'enableUsuario');
}

function usuarioValido(email, pass, nombre, apellido, isInsert) {

	if(isInsert && ($.trim(email) == "" || $.trim(email).length < 1 || $.trim(email).length > 50)){
    mostrarMensaje("divMensajeError", "El email no es válido. Debe poseer como máximo 50 caracteres.");
		return false;
	}

	if(isInsert && (!isEmail(email))){
		mostrarMensaje("divMensajeError", "El email ingresado no tiene un formato correcto.");
		return false;
	}

	if(isInsert && ($.trim(pass) == "" || $.trim(pass).length < 1 || $.trim(pass).length > 50)){
		mostrarMensaje("divMensajeError", "La contraseña no es válida. Debe poseer como máximo 50 caracteres.");
		return false;
	}

	if($.trim(nombre) == "" || $.trim(nombre).length < 1 || $.trim(nombre).length > 30){
		mostrarMensaje("divMensajeError", "El nombre no es válido. Debe poseer como máximo 30 caracteres.");
		return false;
	}

	if($.trim(apellido) == "" || $.trim(apellido).length < 1 || $.trim(apellido).length > 30){
		mostrarMensaje("divMensajeError", "El apellido no es válido. Debe poseer como máximo 30 caracteres.");
		return false;
	}

	return true;
}

function insertarUsuario() {

	var email = $("#email").val().trim();
	var pass = $("#pass").val().trim();
	var nombre = $("#nombre").val().trim();
	var apellido = $("#apellido").val().trim();

	if (usuarioValido(email, pass, nombre, apellido, true)) {
		$.ajax({
			url : '/helpers/UsuarioAjaxHelper.php',
			data : {
				metodo : "createUsuarioParametros",
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
          $("#modalUsuario").modal('hide');
          obtenerUsuarios();
          mostrarMensaje("divExito", "Registración exitosa.", true);
				} else {
					mostrarMensaje("divError", "Error en registracion.", true);
				}
			},
			error : function(error) {
        mostrarMensaje("divError", "Ups, ocurrio un error!", true);
			}
		});
	}
}

function actualizarUsuario(idUsuario) {

	var nombre = $("#nombre").val().trim();
	var apellido = $("#apellido").val().trim();

	if (usuarioValido(email, pass, nombre, apellido, false)) {
		$.ajax({
			url : '/helpers/UsuarioAjaxHelper.php',
			data : {
				metodo : "updateUsuarioParameters",
        idUsuario: idUsuario,
				nombre : nombre,
				apellido : apellido
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				if (result) {
          $("#modalUsuario").modal('hide');
          obtenerUsuarios();
          mostrarMensaje("divExito", "Actualización exitosa.", true);
				} else {
          mostrarMensaje("divError", "No se pudo actualizar el usuario.", true);
				}
			},
			error : function(error) {
				mostrarMensaje("divError", "Ups, ocurrio un error!", true);
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

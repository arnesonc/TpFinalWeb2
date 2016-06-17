$(document).ready(function(){

  obtenerUsuarios();

});

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

  console.log(tblUsuarios);

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
      alert("Ups, ocurrio un error! " + error);
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

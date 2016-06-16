$(document).ready(function(){

  obtenerUsuarios();

});

function armarTablaUsuarios(listaUsuarios){

  var fila = "";
  $("#bodyUsuarios").html("");
  $.each(listaUsuarios, function(index, usuario) {
    fila = "<tr><td>" + usuario.email + "</td>";
    fila += "<td>" + usuario.nombre + "</td>";
    fila += "<td>" + usuario.apellido + "</td>";
    fila += "<td>" + usuario.descripcion_rol + "</td>";
    fila += "<td>" + usuario.descripcion_estado_usuario + "</td>";
    fila += "<td><button id='btnEditarUsuario' name='" + usuario.id +"' class='btn btn-primary' onclick='editarUsuario(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";

    if(usuario.id_estado_usuario == 1){
      fila += "<button id='btnDesactivarUsuario' name='"+ usuario.id + "' class='btn btn-warning' onclick='deshabilitarUsuario(this);'><span class='glyphicon glyphicon-remove'></span> Desactivar</button>";
    }else{
      fila += "<button id='btnDesactivarUsuario' name='"+ usuario.id + "' class='btn btn-success' onclick='habilitarUsuario(this);'><span class='glyphicon glyphicon-ok'></span> Activar</button>";
    }

    fila += "</td></tr>";

    $("#bodyUsuarios").append(fila);
  });

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

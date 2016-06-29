$(document).ready(function(){

  $("#btnReporteContenidistas").click(function(){
    generarReporteContenidistas();
  });

  $("#btnReporteClientes").click(function(){
    generarReporteClientes();
  });

  $("#btnReporteProductos").click(function(){
    generarReporteProductos();
  });

});

function generarReporteClientes(){
  $.ajax({
      url : '/helpers/ClienteAjaxHelper.php',
      data : {
        metodo : "getAllClientes",
      },
      type : 'POST',
      dataType : "json",
      success : function(listaClientes) {
        armarHTMLReporteClientes(listaClientes);
      },
      error : function(error) {
        mostrarMensaje("divError", "Ups, ocurrio un error!", true);
      }
  });
}

function generarReporteProductos(){

}

function generarReporteContenidistas(){

  $.ajax({
      url : '/helpers/UsuarioAjaxHelper.php',
      data : {
        metodo : "getAllUsuariosRedactores",
      },
      type : 'POST',
      dataType : "json",
      success : function(listaUsuariosRedactores) {
        armarHTMLReporteContenidistas(listaUsuariosRedactores);
      },
      error : function(error) {
        mostrarMensaje("divError", "Ups, ocurrio un error!", true);
      }
  });
}

function armarHTMLReporteClientes(listaClientes){
  var html = "<!DOCTYPE html><html lang='en'><head><meta charset='utf-8'>";
  html += "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
  html += "<meta name='viewport' content='width=device-width, initial-scale=1'>";
  html += "<meta name='description' content=''>";
  html += "<meta name='author' content=''><link href='../css/bootstrap.css' rel='stylesheet'></head><body><div class='container'><table class='table table-striped table-bordered'>";
  html += "<thead><tr><th>Email</th><th>Nombre</th><th>Apellido</th><th>Calle</th><th>Número</th><th>Dpto</th><th>Estado</th><th>Ciudad</th>";
  html += "</tr></thead><tbody>";

  $.each(listaClientes, function(index, cliente) {

    html += "<tr><td>" + cliente.email + "</td><td>" + cliente.nombre + "</td><td>" + cliente.apellido + "</td><td>" + cliente.calle + "</td><td>" + cliente.numero_calle + "</td><td>" + cliente.departamento + "</td><td>" + cliente.descripcion_estado_cliente + "</td><td>" + cliente.descripcion_ciudad + "</td></tr>";

    // Son de asignacion dado que el html se completa dentro de las funciones
    html = armarHTMLSuscripcionesCliente(html, cliente);
    html = armarHTMLComprasUnitariasCliente(html, cliente);
  });

  html += "</tbody></table></div></body></html>";

  $.redirect('/helpers/GetPDF.php', {'contentPDF': html, 'namePDF': 'clientes-y-productos'});
}

function armarHTMLSuscripcionesCliente(html, cliente){
  $.ajax({
      url : '/helpers/SuscripcionAjaxHelper.php',
      data : {
        metodo : "getSuscripcionesByIdCliente",
        idCliente: cliente.id
      },
      type : 'POST',
      dataType : "json",
      async: false,
      success : function(listaSuscripciones) {
        if(listaSuscripciones != null){
          $.each(listaSuscripciones, function(index, suscripcion) {
            html += "<tr><td colspan='8'><strong>Compras del cliente " + cliente.email + "<strong><table class='table table-striped table-bordered'><thead><tr><th>Publicación</th><th>Cantidad de meses</th><th>Precio</th><th>Fecha</th></tr></thead><tbody>";
            html += "<tr><td>" + suscripcion.nombrePublicacion + "</td><td>" + suscripcion.cantidad_meses + "</td><td>" + suscripcion.fecha + "</td><td>" + suscripcion.precio + "</td></tr>";
          });
        }else{
          html += "<tr><td colspan='8'>El cliente no posee suscripciones.</td></tr>";
        }

        html += "</tbody></table></td></tr>";
      },
      error: function(error){
        console.log("error" + error);
      }
  });

  return html;
}

function armarHTMLComprasUnitariasCliente(html, cliente){
  $.ajax({
      url : '/helpers/CompraUnitariaAjaxHelper.php',
      data : {
        metodo : "getCompraUnitariaByIdCliente",
        idCliente: cliente.id
      },
      type : 'POST',
      dataType : "json",
      async: false,
      success : function(listaComprasUnitarias) {
        if(listaComprasUnitarias != null){
          console.log(listaComprasUnitarias);
          $.each(listaComprasUnitarias, function(index, compraUnitaria) {
            html += "<tr><td colspan='8'><strong>Suscripciones del cliente " + cliente.email + "<strong><table class='table table-striped table-bordered'><thead><tr><th>Número</th><th>Fecha</th><th>Nombre de la publicación</th></tr></thead><tbody>";
            html += "<tr><td>" + compraUnitaria.id_numero + "</td><td>" + compraUnitaria.fecha + "</td><td>" + compraUnitaria.nombrePublicacion + "</td></tr>";
          });
        }else{
          html += "<tr><td colspan='8'>El cliente no posee compras.</td></tr>";
        }

        html += "</tbody></table></td></tr>";
      },
      error: function(error){
        console.log("error" + error);
      }
  });

  return html;
}


function armarHTMLReporteContenidistas(listaUsuariosRedactores){
  var html = "<!DOCTYPE html><html lang='en'><head><meta charset='utf-8'>";
  html += "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
  html += "<meta name='viewport' content='width=device-width, initial-scale=1'>";
  html += "<meta name='description' content=''>";
  html += "<meta name='author' content=''><link href='../css/bootstrap.css' rel='stylesheet'></head><body><table class='table table-responsive table-bordered' cellspacing='0'>";
  html += "<thead><tr><th>Email</th><th>Nombre</th><th>Apellido</th><th>Estado</th>";
  html += "</tr></thead><tbody>";

  $.each(listaUsuariosRedactores, function(index, usuario) {

    html += "<tr><td>" + usuario.email + "</td><td>" + usuario.nombre + "</td><td>" + usuario.apellido + "</td><td>" + usuario.descripcion_estado_usuario + "</td></tr>";
  });

  html += "</tbody></table></body></html>";

  $.redirect('/helpers/GetPDF.php', {'contentPDF': html, 'namePDF': 'contenidistas'});
}

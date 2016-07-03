hp$(document).ready(function() {

    $("#btnReporteContenidistas").click(function() {
        generarReporteContenidistas();
    });

    $("#btnReporteClientes").click(function() {
        generarReporteClientes();
    });

    $("#btnReporteProductos").click(function() {
        generarReporteProductos();
    });

});

function generarReporteClientes() {
    $.ajax({
        url: '/helpers/ReporteAjaxHelper.php',
        data: {
            metodo: "generarReporteClientes",
        },
        type: 'POST',
        dataType: "json",
        success: function(html) {
            $.redirect('/helpers/GetPDF.php', {
                'contentPDF': html,
                'namePDF': 'clientes-y-productos'
            });
        },
        error: function(error) {
            mostrarMensaje("divError", "Ups, ocurrio un error!", true);
        }
    });
}

function generarReporteProductos() {

}

function generarReporteContenidistas() {

    $.ajax({
        url: '/helpers/UsuarioAjaxHelper.php',
        data: {
            metodo: "getAllUsuariosRedactores",
        },
        type: 'POST',
        dataType: "json",
        success: function(listaUsuariosRedactores) {
            armarHTMLReporteContenidistas(listaUsuariosRedactores);
        },
        error: function(error) {
            mostrarMensaje("divError", "Ups, ocurrio un error!", true);
        }
    });
}

function armarHTMLReporteContenidistas(listaUsuariosRedactores) {
    var html = "<!DOCTYPE html><html lang='en'><head><meta charset='utf-8'>";
    html += "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    html += "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    html += "<meta name='description' content=''>";
    html += "<meta name='author' content=''><link href='../css/bootstrap.css' rel='stylesheet'></head><body><div class='container'><h3>Editorial Jr - Reporte: Información de contenidistas</h3><table class='table table-striped    table-bordered'>";
    html += "<thead><tr style='background-color: #F3F781;'><th>Email</th><th>Nombre</th><th>Apellido</th><th>Estado</th>";
    html += "</tr></thead><tbody>";

    $.each(listaUsuariosRedactores, function(index, usuario) {

        html += "<tr><td>" + usuario.email + "</td><td>" + usuario.nombre + "</td><td>" + usuario.apellido + "</td><td>" + usuario.descripcion_estado_usuario + "</td></tr>";
    });

    html += "</tbody></table></div></body></html>";

    $.redirect('/helpers/GetPDF.php', {'contentPDF': html, 'namePDF': 'contenidistas'});
}

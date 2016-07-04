$(document).ready(function() {
    obtenerCantidadPaginas();
});

function obtenerCantidadPaginas() {
    $.ajax({
        url: '/helpers/PublicacionAjaxHelper.php',
        data: {
            metodo: "getNumberOfPublications",
        },
        type: 'POST',
        dataType: "json",
        async: false,
        success: function(numberOfPublications) {
            armarPaginador(Math.round(numberOfPublications / 8));
        },
        error: function(error) {
            mostrarMensaje("divError", "Ups, ocurrio un error!", true);
        }
    });
}

function armarPaginador(cantidadPaginas) {
    var offset = 1;
    var itemsPorPagina = 8;

    obtenerPublicacionesPaginado(offset, itemsPorPagina);

    $('#page-selection').bootpag({
        total: cantidadPaginas
    }).on("page", function(event, num) {
        offset = (num - 1) * itemsPorPagina;

        if(offset == 0){
          offset = 1;
        }

        obtenerPublicacionesPaginado(offset, itemsPorPagina);

        // ... after content load -> change total to 10
        // $(this).bootpag({
        //     total: 10,
        //     maxVisible: 10
        // });
    });
}

function obtenerPublicacionesPaginado(offset, itemsPorPagina) {
  $.ajax({
      url: '/helpers/PublicacionAjaxHelper.php',
      data: {
          metodo: "getPublicacionesPaginado",
          offset: offset,
          itemsPorPagina: itemsPorPagina
      },
      type: 'POST',
      dataType: "json",
      async: false,
      success: function(result) {
          armarHtmlPublicaciones(result);
      },
      error: function(error) {
          mostrarMensaje("divError", "Ups, ocurrio un error!", true);
      }
  });
}

function armarHtmlPublicaciones(result){
    var htmlGeneral = "";
    var html = "";

    htmlGeneral = "<div class='row text-center'>";

    $.each(result, function(index, publicacion) {

      html = "<div class='col-md-3 col-sm-6 hero-feature'>";
      html += "    <div class='thumbnail'>";
      html += "        <a href='url-del-numero.html'>";
      html += "            <img src='" + publicacion.url_ultima_portada + "' alt='Imagen de publicación: " + publicacion.nombre + "'>";
      html += "        </a>";
      html += "        <div class='caption'>";
      html += "            <h3>" + publicacion.nombre + "</h3>";
      html += "            <p>";
      html += "                <a href='#' class='btn btn-primary'>Comprar</a>";
      html += "                <a href='#' class='btn btn-default'>Descargar</a>";
      html += "            </p>";
      html += "        </div>";
      html += "    </div>";
      html += "</div>";

      htmlGeneral += html;
    });

    htmlGeneral += "</div>";

    $("#content").html(htmlGeneral);
}

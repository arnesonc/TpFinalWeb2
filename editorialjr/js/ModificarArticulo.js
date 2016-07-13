$(document).ready(function () {
    crearMapa();
});

var map;
var latitud = 0;
var longitud = 0;

function crearMapa() {
    var script = "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC8qdt_ZyQL7Ea1dirrshhtQycf1UYGAQQ&callback=initMap' async defer></script>";
    $("#mapa").html(script);
}

function initMap() {

    var myLatlng = {lat: latitud, lng: longitud};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: myLatlng
    });

    marcador = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Lugar de los hechos'
    });
}

function modificarArticulo(idArticulo) {
    $("#idArticulo").val(idArticulo);
    traerArticulo(idArticulo);
}

function traerArticulo(idArticulo) {
    //trae el json con el articulo
    $.ajax({
        url: '/helpers/ArticuloAjaxHelper.php',
        data: {
            metodo: "getArticuloById",
            id_articulo: idArticulo,
        },
        type: 'POST',
        dataType: "json",
        success: function (articulo) {console.log(articulo);console.log("aquillega");
            cargarArticulo(articulo);
        },
        error: function (error) {
            alert("Upa, ocurrio un error! " + error);
        }
    });

}

$("#btnGuardar").click(function(){

  //$("#lat").val(window.lat);
  //$("#lng").val(window.lng);
  $("#contenido").val($('#summernote').summernote('code'));


  $('#myForm').submit();
});

function cargarArticulo(articulo) {
    //append donde corresponda
    $('#titulo').val(articulo.titulo);
    $('#copete').val(articulo.copete);
    $('#summernote').summernote('code', articulo.url_contenido);
    $('#seccion').val(articulo.id_seccion);
    $("#idNumero").val(articulo.id_numero);
    //latitud = Number(articulo.latitud);
    //longitud = Number(articulo.longitud);
}

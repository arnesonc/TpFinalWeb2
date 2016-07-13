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

function leerArticulo(idArticulo) {
    traerImagen(idArticulo);
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
        success: function (articulo) {
            renderArticulo(articulo);
        },
        error: function (error) {
            alert("Upa, ocurrio un error! " + error);
        }
    });

}

function renderArticulo(articulo) {
    //append donde corresponda
    $('.site-heading').find('h1').html(articulo.titulo);
    $('.subheading').html(articulo.copete);
    $('#contenido').html(articulo.url_contenido);
    $('#fecha').html(articulo.fecha_cierre);
    traerUsuario(articulo.id_usuario);
    latitud = Number(articulo.latitud);
    longitud = Number(articulo.longitud);
}

function traerImagen(idArticulo) {

    //trae la url de la imagen

    $.ajax({
        url: '/helpers/ArticuloAjaxHelper.php',
        data: {
            metodo: "getImagenUrlByArticuloId",
            idArticulo: idArticulo,
        },
        type: 'POST',
        dataType: "json",
        success: function (imagen) {
            $(".intro-header").attr('style', 'background-image: url("' + imagen.url + '")');
        },
        error: function (error) {
            alert("Upa, ocurrio un error!");
        }
    });
}

function traerUsuario(idUsuario) {

    $.ajax({
        url: '/helpers/UsuarioAjaxHelper.php',
        data: {
            metodo: "getUsuarioById",
            idUsuario: idUsuario,
        },
        type: 'POST',
        dataType: "json",
        success: function (usuario) {
            if(usuario){
                $('#autor').html(usuario.nombre);
            }
        },
        error: function (error) {
            alert("Upa, ocurrio un error! ");
        }
    });
}

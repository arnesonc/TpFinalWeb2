function leerArticulo(idArticulo){
    
    traerImagen(idArticulo);
    traerArticulo(idArticulo);
}

function traerArticulo(idArticulo){

    //trae el json con el articulo

    $.ajax({
        url     :   '/helpers/ArticuloAjaxHelper.php',
        data    : {
                    metodo : "getArticuloById",
                    id_articulo : idArticulo,
                  },
        type    :   'POST',
        dataType : "json",
        success : function(articulo) {
            renderArticulo(articulo);
        },
        error : function(error) {
            alert("Upa, ocurrio un error! " + error);
        }
    });

}

function renderArticulo(articulo){
    //append donde corresponda

    $('.site-heading').find('h1').html(articulo.titulo);
    $('.subheading').html(articulo.copete);
    $('#contenido').html(articulo.url_contenido);
    $('#fecha').html(articulo.fecha_cierre);

    traerUsuario(articulo.id_usuario);

    window.lat = articulo.latitud;
    window.lng = articulo.longitud;
    
}


function traerImagen(idArticulo){

    //trae la url de la imagen

    $.ajax({
        url     :   '/helpers/ArticuloAjaxHelper.php',
        data    : {
            metodo : "getAllArticulosFromNumByUser",
            id_articulo : idArticulo,
        },
        type : 'POST',
        dataType : "json",
        success : function(articulo) {
            renderArticulo(articulo);
        },
        error : function(error) {
            alert("Upa, ocurrio un error! " + error);
        }
    });
    
}

function traerUsuario(idUsuario){

    $.ajax({
        url     :   '/helpers/UsuarioAjaxHelper.php',
        data    : {
            metodo : "getUsuarioById",
            idUsuario : idUsuario,
        },
        type    :   'POST',
        dataType : "json",
        success : function(usuario) {
            $('#autor').html(usuario.nombre);
        },
        error : function(error) {
            alert("Upa, ocurrio un error! " + error);
        }
    });
}

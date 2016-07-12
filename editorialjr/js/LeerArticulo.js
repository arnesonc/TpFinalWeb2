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

function renderArticulo(articulo){
    //append donde corresponda
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
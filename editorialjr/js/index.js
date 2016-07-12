$(document).ready(function () {
    obtenerCantidadPaginas();

    $("#btnIniciarSesion").click(function (event) {
        event.preventDefault();
        mostrarModalLogin();
    });

    $("#btnAceptarInicioSesion").click(function (event) {
        event.preventDefault();
        iniciarSesion();
    });
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
        success: function (numberOfPublications) {
            armarPaginador(Math.ceil(numberOfPublications / 8));
        },
        error: function (error) {
            mostrarMensaje("divError", "Ups, ocurrio un error!", true);
        }
    });
}

function armarPaginador(cantidadPaginas) {
    var offset = 0;
    var itemsPorPagina = 8;

    obtenerPublicacionesPaginado(offset, itemsPorPagina);

    $('#page-selection').bootpag({
        total: cantidadPaginas
    }).on("page", function (event, num) {
        offset = (num - 1) * itemsPorPagina;

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
        success: function (result) {
            var listaPublicaciones = result;
            var idCliente = obtenerSessionID();
            listarSuscripcionesDelCliente(idCliente, listaPublicaciones);
        },
        error: function (error) {
            mostrarMensaje("divError", "Ups, ocurrio un error!", true);
        }
    });
}

/*RETORNA UN ARRAY CON LAS PUBLICACIONES A LAS QUE ESTA SUSCRITO EL CLIENTE LOGUEADO*/
function listarSuscripcionesDelCliente(idCliente, listaPublicaciones) {
    $.ajax({
        url: '/helpers/SuscripcionAjaxHelper.php',
        data: {
            metodo: "listarSuscripcionesDelCliente",
            idCliente: idCliente,
        },
        type: 'POST',
        dataType: "json",
        success: function (result) {
            var publicacionesAdquiridas = result;
            ultimosNumerosComprados(idCliente, publicacionesAdquiridas, listaPublicaciones);
        },
        error: function (error) {
            mostrarMensaje("divMensajeError", "Ups, ocurrio un error interno ", true);
        }
    });
}

/*TRAE UNA LISTA DE PUBLICACIONES DONDE EL ULTIMO NUMERO FUE COMPRADO POR EL CLIENTE LOGUEADO*/
function ultimosNumerosComprados(idCliente, publicacionesAdquiridas, listaPublicaciones) {
    $.ajax({
        url: '/helpers/CompraUnitariaAjaxHelper.php',
        data: {
            metodo: "getComprasUnitariasByIdCliente",
            idCliente: idCliente,
        },
        type: 'POST',
        dataType: "json",
        success: function (result) {
            var ultimosNumerosComprados = result;
            armarHtmlPublicaciones(publicacionesAdquiridas, listaPublicaciones, ultimosNumerosComprados);
        },
        error: function (error) {
            mostrarMensaje("divMensajeError", "Ups, ocurrio un error interno ", true);
        }
    });
}

function armarHtmlPublicaciones(publicacionesAdquiridas, listaPublicaciones, ultimosNumerosComprados) {
    var htmlGeneral = "";
    var html = "";
    var clienteID = obtenerSessionID();
    htmlGeneral = "<div class='row text-center'>";

    if (listaPublicaciones != null) {
        $.each(listaPublicaciones, function (index, publicacion) {

            if (publicacionesAdquiridas != null) {
                //DETERMINA SI LA PUBLICACION FUE ADQUIRIDA POR EL CLIENTE
                var publicacionAdquirida = false;
                $.each(publicacionesAdquiridas, function (index, pub) {
                    if (pub.id_publicacion == publicacion.id) {
                        publicacionAdquirida = true;
                    }
                });
            }
            if (ultimosNumerosComprados != null) {
                var numeroComprado = false;
                $.each(ultimosNumerosComprados, function (index, num) {
                    if (num.id_publicacion == publicacion.id) {
                        numeroComprado = true;
                    }
                });
            }

            html = "<div class='col-md-3 col-sm-6 hero-feature'>";
            html += "    <div class='thumbnail'>";
            html += "        <a >";
            html += "            <img src='" + publicacion.url_ultima_portada + "' alt='Imagen de publicación: " + publicacion.nombre + "'>";
            html += "        </a>";
            html += "        <div class='caption'>";
            html += "            <h3>" + publicacion.nombre + "</h3>";
            html += "            <p>";
            //SI LA PUBLICACION FUE ADQUIRIDA POR EL CLIENTE (el cliente esta suscrito a ella), MOSTRAMOS EL BOTON VER.
            if (publicacionAdquirida) {
                //TODO:agregar funcionalidad al boton para ver publicacion.
                html += "                <a name='" + publicacion.id + "' class='btn btn-success'>Suscripcion adquirida</a>";
                html += "                <button onclick='verNumerosDeEstaPublicacion(this);' name='" + publicacion.id + "'class='btn btn-info'>Ver</button>";
            } else {
                if (numeroComprado) {
                    //TODO:agregar funcionalidad al boton para ver el numero.
                    html += "                <a name='" + publicacion.id + "' class='btn btn-success'>Numero Adquirido</a>";
                } else {
                    html += "                <a onclick='comprarUltimoNumero(this);' name='" + publicacion.id + "' class='btn btn-primary'>Comprar</a>";
                }
                html += "                <a onclick='suscribirCliente(this);' name='" + publicacion.id + "'class='btn btn-info'>Suscribir</a>";
            }
            html += "            </p>";
            html += "        </div>";
            html += "    </div>";
            html += "</div>";

            htmlGeneral += html;
        });
    }

    htmlGeneral += "</div>";

    $("#content").html(htmlGeneral);
}

// Javascript para login

function mostrarModalLogin() {
    $("#divMensajeError").hide();
    $("#modalSeccion").modal('show');
    limpiarFormularioLogin();
}

function limpiarFormularioLogin() {
    $("#email").val("");
    $("#pass").val("");
}

function iniciarSesion() {
    var email = $("#email").val().trim();
    var pass = $("#pass").val().trim();

    if (validateEmailPass(email, pass)) {
        $.ajax({
            url: '/helpers/ClienteAjaxHelper.php',
            data: {
                metodo: "checkUserAndPass",
                email: email,
                pass: pass
            },
            type: 'POST',
            dataType: "json",
            success: function (result) {
                if (result === true) {
                    window.location.href = "/";
                } else {
                    mostrarMensaje("divMensajeError", result, true);
                }
            },
            error: function (error) {
                mostrarMensaje("divMensajeError", "Ups, ocurrio un error al loguear! ", true);
            }
        });
    }
}

function suscribirCliente(button) {
    //FIXME: mercado pago
    if (obtenerSessionID() != false) {
        $.ajax({
            url: '/helpers/SuscripcionAjaxHelper.php',
            data: {
                metodo: "suscribirCliente",
                idPublicacion: button.name,
                idCliente: obtenerSessionID(),
            },
            type: 'POST',
            dataType: "json",
            success: function (result) {
                if (result) {
                    window.open(result,"","height=800, width=800");
                    obtenerCantidadPaginas();
                } else {
                    mostrarMensaje("no se pudo suscribir");
                    alert("no se pudo suscribir");
                }
            },
            error: function (error) {
                mostrarMensaje("divMensajeError", "Ups, ocurrio un error al suscribir! ", true);
            }
        });
    } else {
        mostrarModalLogin();
    }
}

function comprarUltimoNumero(button) {
    //FIXME: mercado pago
    if (obtenerSessionID() != false) {
        $.ajax({
            url: '/helpers/CompraUnitariaAjaxHelper.php',
            data: {
                metodo: "comprarUltimoNumero",
                idPublicacion: button.name,
                idCliente: obtenerSessionID(),
            },
            type: 'POST',
            dataType: "json",
            success: function (result) {
                if (result) {
                    window.open(result,"","height=800, width=800");
                    obtenerCantidadPaginas();
                } else {
                    mostrarMensaje("no se pudo comprar");
                    alert("no se pudo comprar");
                }
            },
            error: function (error) {
                mostrarMensaje("divMensajeError", "Ups, ocurrio un error al suscribir! ", true);
            }
        });
    } else {
        mostrarModalLogin();
    }
}
/*RETORNA TRUE SI EL CLIENTE ESTA SUSCRITO A LA PUBLICACION*/
function clienteSuscrito(idCliente, idPublicacion) {
    $.ajax({
        url: '/helpers/SuscripcionAjaxHelper.php',
        data: {
            metodo: "clienteSuscrito",
            idPublicacion: idPublicacion,
            idCliente: idCliente,
        },
        type: 'POST',
        dataType: "json",
        async: false,
        success: function (result) {
            return result;
        },
        error: function (error) {
            mostrarMensaje("divMensajeError", "Ups, ocurrio un error interno ", true);
        }
    });
}

function verNumerosDeEstaPublicacion(button) {
    var idPublicacion = button.name;
    $.redirect('client-listar-numeros.php', {'idPublicacion': idPublicacion});
}

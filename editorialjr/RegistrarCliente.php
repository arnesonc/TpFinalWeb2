<?php

require_once(__DIR__ . "/service/PaisService.php");

$paisService = new PaisService;

$arrayPaises = $paisService->getAllPais();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administración Editorial Jr</title>

    <!-- Nuestro CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Side Bar CSS -->
    <link href="css/clientStyle.css" rel="stylesheet">

    <!-- CSS de las Datatables-->
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/footer-distributed.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index.php">Editorial Jr</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <form name="frmFormulario" class="form-horizontal">
                    <fieldset>
                        <legend> Editorial Jr - Registración</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtEmail">Email</label>
                            <div class="col-md-3">
                                <input id="txtEmail" type="text" name="txtEmail" class="form-control input-md"
                                       maxlength="50" placeholder="Email"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtPass">Contraseña</label>
                            <div class="col-md-3">
                                <input id="txtPass" type="password" placeholder="Contraseña"
                                       class="form-control input-md" name="txtPass" maxlength="30"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtNombre">Nombre</label>
                            <div class="col-md-3">
                                <input id="txtNombre" type="text" name="txtNombre" class="form-control input-md"
                                       maxlength="30" placeholder="Nombre"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtApellido">Apellido</label>
                            <div class="col-md-3">
                                <input id="txtApellido" type="text" name="txtApellido" class="form-control input-md"
                                       maxlength="30" placeholder="Apellido"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ddlPais">Pais</label>
                            <div id="divContenidoPaises" class="col-md-3">
                                <select id="ddlPaises" class="form-control">
                                    <?php
                                    foreach ($arrayPaises as $key => $pais) {
                                        ?>
                                        <option
                                            value="<?php echo $pais->id; ?>"><?php echo $pais->descripcion; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="divRegion" class="form-group">
                            <label class="col-md-4 control-label" for="ddlRegiones">Región</label>
                            <div class="col-md-3">
                                <div id="divContenidoRegiones" class="campo">
                                </div>
                            </div>
                        </div>

                        <div id="divRegion" class="form-group">
                            <label class="col-md-4 control-label" for="ddlCiudades">Ciudad</label>
                            <div class="col-md-3">
                                <div id="divContenidoCiudades" class="campo">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtCalle">Calle</label>
                            <div class="col-md-3">
                                <input id="txtCalle" type="text" name="txtCalle" class="form-control input-md"
                                       maxlength="30" placeholder="Calle"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtNroCalle">Número</label>
                            <div class="col-md-3">
                                <input id="txtNroCalle" type="text" name="txtNroCalle" class="form-control input-md"
                                       maxlength="30" placeholder="Número de calle"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtCodigoPostal">Código postal</label>
                            <div class="col-md-3">
                                <input id="txtCodigoPostal" type="text" name="txtCodigoPostal"
                                       class="form-control input-md" maxlength="11" placeholder="Código postal"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtCodigoPostal">Piso</label>
                            <div class="col-md-3">
                                <input id="txtPiso" type="text" name="txtPiso" class="form-control input-md"
                                       maxlength="5" placeholder="Piso"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtDepartamento">Departamento</label>
                            <div class="col-md-3">
                                <input id="txtDepartamento" type="text" name="txtDepartamento"
                                       class="form-control input-md" maxlength="5" placeholder="Departamento"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="txtDetalleDireccion">Detalle</label>
                            <div class="col-md-3">
                                <textarea id="txtDetalleDireccion" rows="3" class="form-control input-md" cols="20"
                                          maxlength="150" placeholder="Detalle de la dirección"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="send"></label>
                            <div class="col-md-4">
                                <div id="divMensajeError" class="col-md-9 alert alert-danger fade in oculto">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="send"></label>
                            <div class="col-md-4">
                                <input id="btnAceptar" type="button" class="btn btn-primary" name="aceptar"
                                       value="Aceptar"/>
                                <input type="reset" name="cancelar" class="btn btn-default" value="Cancelar"/>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->

<footer class="footer-distributed">

    <div class="footer-right">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="https://github.com/germg/TpFinalWeb2"><i class="fa fa-github"></i></a>
    </div>

    <div class="footer-left">

        <p class="footer-links">
            <a href="/index.php">Home</a>
            ·
            <a href="#">About</a>
            ·
            <a href="/admin-login.php">Administrar</a>
        </p>

        <p>EditorialJR &copy; 2016</p>
    </div>

</footer>

<script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="../js/common.js" type="text/javascript"></script>
<script src="js/jquery.redirect.js" type="text/javascript"></script>
<script src="../js/RegistrarCliente.js" type="text/javascript"></script>
</body>
</html>

<?php
require_once(__DIR__ . "/common/sesionValidaIndex.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
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
    <title>Editorial Jr</title>
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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['session']) && isset($_SESSION['session']["login"])
                    && $_SESSION['session']["login"] == "ok"
                ) {
                    ?>
                    <li>
                        <a href="/client-listar-suscripciones.php">Suscripciones</a>
                    </li>
                    <li>
                        <a href="client-listar-numeros-comprados.php">Compras</a>
                    </li>
                    <li>
                        <a href="/logoutIndex.php">Cerrar sesión</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a id="btnIniciarSesion" href="#">Iniciar sesión</a>
                    </li>
                    <li>
                        <a href="RegistrarCliente.php">Registrarse</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

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
                        <a>Bienvenido <?php echo $_SESSION['session']['nombre']; ?>! </a>
                    </li>
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

<!-- header articulo -->
<header class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Clean Blog</h1>

                    <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- fin header articulo -->

<!-- CONTENIDO -->
<div class="container">
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10">
            <div class="detalles">
                <p>Escrito por <span id="autor">PEPE</span> | <span id="fecha">12/03/2016</span>
                <p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10">
            <div id="contenido">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10">
            <div id="map"></div>
        </div>
    </div>
</div>

<!-- FIN DE CONTENIDO -->

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


<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

<!-- Paginacion -->
<script src="js/jquery.bootpag.min.js"></script>

<!-- JS especifico -->
<script src="js/common.js"></script>

<!-- JS especifico -->
<script src="js/index.js"></script>

<!-- jquery redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>

<!-- leer articulo.js-->
<script src="js/LeerArticulo.js"></script>

<!-- obtener variables post-->
<script type="text/javascript" language="JavaScript">
    leerArticulo(<?php echo $_POST["idArticulo"] ?>);
</script>

<div id="mapa">
</div>
</body>
</html>


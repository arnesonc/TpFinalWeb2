<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editorial Jr</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">

    <!-- Nuestro CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>

    <body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="img/logo.png" alt="Logo Editorial Jr">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Iniciar sesión</a>
                    </li>
                    <li>
                        <a href="RegistrarCliente.php">Registrarse</a>
                    </li>
                    <!-- <li>
                        <a href="#">contacto</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <section id="section_ultimos">
        <div class="container">
            <!-- Title -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Últimos Números</h3>
                </div>
            </div>
            <!-- /.row -->

            <div id="divError" class="alert alert-danger oculto">
    			  </div>

            <div id="content" class="row text-center">
            </div>

            </div>

            <!-- paginado-->
            <div class="container">
                <div class="text-center">
                    <ul class="pagination">
                      <div id="page-selection">
                      </div>
                    </ul>
                </div>
            </div><!-- /paginado-->
        </div>
    </section><!-- /ultimos -->

    <!-- Footer -->
    <section id="section_footer">
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Copyright &copy; Editorial Jr 2016</p>
                    </div>
                </div>
            </div>
        </footer>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Paginacion -->
    <script src="js/jquery.bootpag.min.js"></script>

    <!-- JS especifico -->
    <script src="js/index.js"></script>

    </body>

</html>

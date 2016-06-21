<?php

session_start();
if($_SESSION['session']['login'] != "ok"){
    header('Location: ./admin-login.php');
}

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
    <link href="css/simple-sidebar.css" rel="stylesheet">

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
                    <a class="navbar-brand" href="#">Editorial Jr</a>
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
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="wrapper">
                        <!-- Sidebar -->
                        <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                                <li class="sidebar-brand">
                                    <a href="#">
                                        <?php echo $_SESSION['session']['nombre']?>
                                    </a>
                                </li>
                                <li>
                                    <h4>Publicaciones</h4>
                                    <a href="#">Creear <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                    <a href="#">Listar <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                                </li>
                                <li>
                                    <h4>Usuarios</h4>
                                    <a href="#">Creear <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                    <a href="#">Listar <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                                </li>
                                <li>
                                    <h4>Reportes</h4>
                                    <a href="#">Creear <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                    <a href="#">Listar <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /#sidebar-wrapper -->

                        <!-- Page Content -->
                        <div id="page-content-wrapper">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1>Simple Sidebar</h1>
                                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /#page-content-wrapper -->
                    </div><!-- /#wrapper -->
                </div><!-- /col -->
            </div><!-- /row -->
        </div>

        <!-- Jquery-->
        <script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"></script>

        <!-- Menu Toggle Script -->
        <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        </script>

    </body>

</html>

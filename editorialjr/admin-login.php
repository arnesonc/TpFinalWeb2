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
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css" />

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
  <form id="signupForm" class="form-horizontal">
    <fieldset>
      <legend>Inicio de sesión</legend>
      <div class="form-group">
        <label class="col-md-4 control-label" for="email">Email</label>
        <div class="col-md-3">
          <input id="email" name="email" placeholder="Email" class="form-control input-md" maxLength="50" type="text">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label" for="pass">Contraseña</label>
        <div class="col-md-3">
          <input id="pass" name="pass" placeholder="Contraseña" class="form-control input-md" maxLength="50" type="password">
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
          <button id="btnIniciarSesion" name="send" class="btn btn-primary">Iniciar sesión</button>
        </div>
      </div>
    </fieldset>
  </form><!-- /form -->
</div>
</div>
</div>
</div>
  <!-- Jquery-->
  <script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>

  <!-- Js Funciones comunes a los demas js-->
  <script src="js/common.js" type="text/javascript"></script>

  <!-- Js listar Cliente-->
  <script src="js/admin-login.js" type="text/javascript"></script>

</body>
</html>

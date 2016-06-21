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
</head>
<body>

  <form id="signupForm" class="form-horizontal">
    <fieldset>
      <legend> Editorial Jr - Inicio de sesión</legend>
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

  <!-- Jquery-->
  <script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>

  <!-- Js Funciones comunes a los demas js-->
  <script src="js/common.js" type="text/javascript"></script>

  <!-- Js listar Cliente-->
  <script src="js/admin-login.js" type="text/javascript"></script>

</body>
</html>

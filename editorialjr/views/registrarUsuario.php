<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editorial Jr</title>
    
    <!-- registrar usuario ajax -->
    <script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="/../js/registrar-usuario.js" type="text/javascript"></script>

    </head>

    <body>
    <!-- seccion formulario -->
    <section id="formulario">
        <div class="container">
            
            <!-- title -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Usuarios</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
        					
                  <!-- form -->
                  <form id="signupForm" method="post" class="form-horizontal" action="">
                      <fieldset>

                        <legend>Nuevo usuario</legend>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email</label>  
                            <div class="col-md-5">
                                <input id="email" name="email" placeholder="Email" class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="pass">Clave</label>
                            <div class="col-md-2">
                                <input id="pass" name="pass" placeholder="" class="form-control input-md" type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombre">Nombre</label>  
                            <div class="col-md-5">
                                <input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="apellido">Apellido</label>  
                            <div class="col-md-5">
                                <input id="apellido" name="apellido" placeholder="Apellido" class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="send"></label>
                          <div class="col-md-4">
                            <button type="button" id="btnAceptar" name="send" class="btn btn-primary btn-lg">Registrar</button>
                            <a href="#" class="btn btn-default btn-lg active" role="button">Cancelar</a>
                          </div>
                        </div>

                      </fieldset>
                  </form>
                  <!-- /form -->

                </div>
        		</div>
  
        </div>
    </section><!-- /seccion formulario -->
    </body>
</html>

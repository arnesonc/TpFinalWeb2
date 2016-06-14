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
	<script src="/../js/CrearPublicacion.js" type="text/javascript"></script>

    </head>

    <body>
    <!-- seccion formulario -->
    <section id="formulario">
        <div class="container">
            
            <!-- title -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>Nueva Publicacion</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
        					
                  <!-- form -->
                  <form id="signupForm" method="post" class="form-horizontal" action="">
                      <fieldset>

                        <legend>Nueva Publicacion</legend>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombre">Nombre de Publicacion</label>  
                            <div class="col-md-5">
                                <input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="destacado">¿es una publicacion destacada?</label>
                            <div class="col-md-2">
                                <input id="destacado" name="destacado" placeholder="" class="form-control input-md" type="checkbox">
                            </div>
                        </div>
						<p>SE CREARA A SU VEZ UNA PUBLICACION EN DRAFT</p>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="url_portada">Url Portada</label>  
                            <div class="col-md-5">
                                <input id="url_portada" name="url_portada" placeholder="url_portada" class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="precio">Precio</label>  
                            <div class="col-md-5">
                                <input id="precio" name="precio" placeholder="Precio" class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="send"></label>
                          <div class="col-md-4">
                            <button type="button" id="btnCrear" name="send" class="btn btn-primary btn-lg">Crear Publicacion</button>
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

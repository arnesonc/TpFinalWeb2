<?php
	include 'header.php';
	include 'side-bar.php';
?>
                        <!-- Page Content -->
                        <div id="page-content-wrapper">
                            <div class="container-fluid">
                                <div class="row">
                                    
                                    <div class="col-lg-12">
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
								                            <button type="submit" id="btnAceptar" name="send" class="btn btn-primary btn-lg">Crear</button>
								                          </div>
								                        </div>
                      								</fieldset>
                  								</form><!-- /form -->
                                        	</div>
                                        </div>
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

        <!-- Js crear usuario-->
        <script src="./js/RegistrarUsuario.js" type="text/javascript"></script>

    </body>

</html>

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

                                        <!-- TABLA-->
                                        <div class="row">
                                            <div id="divTablaUsuarios" class="col-lg-12">
                                            </div>
                                        </div>

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

        <!-- Js listar usuario-->
        <script src="js/ListarUsuarios.js" type="text/javascript"></script>

        <!-- js datatables-->
        <script src="js/datatables.min.js" type="text/javascript"></script>

    </body>

</html>

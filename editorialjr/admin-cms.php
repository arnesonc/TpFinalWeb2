<?php
	include 'header.php';
	include 'side-bar.php';
?>
                        <!-- Page Content -->
                        <div id="page-content-wrapper">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php 
                                        echo "<h1>Bienvenido ".$_SESSION['session']['nombre']."</h1>";
                                        ?>
                                        <p>En este sitio usted podra administrar el contenido de Editorial Jr.</p>
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

<!-- SIDE BAR-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="wrapper">
                        <!-- Sidebar -->
                        <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                                <li class="sidebar-brand">
                                    <a href="#">
                                        <?php echo $_SESSION['session']["nombre"] ?>
                                    </a>
                                </li>
                                <li>
                                    <h4>Suscripciones</h4>
                                    <a href="/client-listar-suscripciones.php"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Publicaciones</a>
                                </li>
                                <li>
                                    <h4>Compras</h4>
                                    <a href="/client-listar-numeros-comprados.php"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Ver compras</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /#sidebar-wrapper -->

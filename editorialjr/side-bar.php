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
                                        <?php echo $_SESSION['session']['nombre']?>
                                    </a>
                                </li>
                                <li>
                                    <h4>Publicaciones</h4>
                                    <a href="#">Crear <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                    <a href="#">Listar <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                                </li>
                                <li>
                                    <h4>Usuarios</h4>
                                    <a href="/admin-crear-usuario.php">Crear <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                    <a href="/admin-listar-Usuarios.php">Listar <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                                </li>
                                <li>
                                    <h4>Reportes</h4>
                                    <a href="#">Crear <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                    <a href="#">Listar <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /#sidebar-wrapper -->

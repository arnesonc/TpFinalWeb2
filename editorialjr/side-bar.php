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
                                    <h4>Publicaciones</h4>
                                    <?php
                                        if($_SESSION['session']['rol'] == '1'){
                                            echo "<a href='/admin-crear-publicacion.php'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Crear</a>";
                                        }
                                    ?>
                                    <a href="/admin-listar-publicaciones.php"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Listar</a>
                                </li>
                                <li>
                                    <h4>Usuarios</h4>
                                    <a href="/admin-listar-usuarios.php"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Listar</a>
                                </li>
                                <?php
                                    if($_SESSION['session']['rol'] == '1'){
                                        echo "<li>";
                                        echo "<h4>Secciones</h4>";
                                        echo "<a href='/admin-listar-secciones.php'><span class='glyphicon glyphicon-th-list' aria-hidden='true'></span> Listar</a>";
                                        echo "</li>";

                                        echo "<li>";
                                        echo "<h4>Reportes</h4>";
                                        echo "<a href='admin-generar-reporte.php'><span class='glyphicon glyphicon-file' aria-hidden='true'></span> Generar reporte</a>";
                                        echo "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /#sidebar-wrapper -->

<?php

require_once(__DIR__."/../service/UsuarioService.php");

//$usuarioService = new UsuarioService;
//$listaUsuarios = $usuarioService->getAllUsuarios();

//var_dump($listaUsuarios);

?>

<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editorial Jr</title>

    <link rel="stylesheet" type="text/css" href="../css/datatables.min.css" />

    <!-- registrar usuario ajax -->
    <script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
	   <script src="../js/ListarUsuarios.js" type="text/javascript"></script>
     <script src="../js/datatables.min.js" type="text/javascript"></script>

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

                <table id="tblUsuarios" class="table table-striped table-bordered" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="bodyUsuarios">
                    
                  </tbody>
                </table>
                </div>
        		</div>

        </div>
    </section><!-- /seccion formulario -->
    </body>
</html>

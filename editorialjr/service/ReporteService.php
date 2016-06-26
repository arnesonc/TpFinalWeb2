<?php
require_once (__DIR__ . "/../helpers/LoggerHelper.php");
require_once (__DIR__ . "/../service/UsuarioService.php");

class ReporteService {

  public function generarReporteContenidistas(){

    $usuarioService = new UsuarioService;
    $result = $usuarioService->getAllUsuariosRedactores();

    $html = "<!DOCTYPE html><html lang='en'><head><meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name='description' content=''>
        <meta name='author' content=''></head><body><table class='table table-responsive table-bordered' cellspacing='0'>
        <thead><tr><th>Email</th><th>Nombre</th><th>Apellido</th><th>Estado</th>
        </tr></thead><tbody>";

        foreach ( $result as $usuario ) {
          $html .= "<tr><td>$usuario->email</td><td>$usuario->nombre</td><td>$usuario->apellido</td><td>$usuario->descripcion_estado_usuario</td></tr>";
    		}

        $html .= "</tbody></table></body></html>";

        return $html;
  }
}

?>

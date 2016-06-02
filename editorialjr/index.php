<?php

require_once(__DIR__."/service/UsuarioService.php");
require_once(__DIR__."/service/CiudadService.php");
require_once(__DIR__."/service/RolService.php");
require_once(__DIR__."/service/RegionService.php");
require_once(__DIR__."/service/ImagenService.php");
require_once(__DIR__."/service/EstadoArticuloService.php");
require_once(__DIR__."/model/UsuarioModel.php");
require_once(__DIR__."/common/ValidationHelper.php");

/* Usar siempre solo este require para logger */
require_once(__DIR__."/common/LoggerHelper.php");

$estadoArticulo = new EstadoArticuloService;

var_dump($estadoArticulo->getEstadoArticuloById(2));

$usuarioService = new UsuarioService;

if(1 == 2){
	$usuarioModel = new UsuarioModel;
	$usuarioModel->email = "redactor@redactor.com";
	$usuarioModel->pass = "1234";
	$usuarioModel->nombre = "redactor";
	$usuarioModel->apellido = "jr";
	
	try{
		$creado = $usuarioService->createUsuario($usuarioModel);
	}catch(Exception $e){
		echo $e;
	}
	echo "creado: $creado";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tp Final</title>
	</head>
	<body>
		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/editorialjr.js"></script>
		<div>
			<p>
				Usuario:
				<?php //echo $usuario->email . " Rol: " . $usuario->getRol()->descripcion; ?>
			</p>
		</div>
		<div>
		<button id="btnObtenerUsuarioAdmin">Obtener usuario admin</button>
		<span id="spnUsuarioAdmin"></span>
		</div>
		<div>
			<button id="btnTest">Test Ajax</button>
			<span id="spnTestAjax"></span>
		</div>
	</body>
</html>
<?php

require_once(__DIR__."/service/UsuarioService.php");
require_once(__DIR__."/service/CiudadService.php");
require_once(__DIR__."/service/RolService.php");
require_once(__DIR__."/service/RegionService.php");
require_once(__DIR__."/service/ImagenService.php");
require_once(__DIR__."/model/UsuarioModel.php");
require_once(__DIR__."/common/ValidationHelper.php");

/* Usar siempre solo este require para logger */
require_once(__DIR__."/common/LoggerHelper.php");

/* asi se obtiene el logger */
//$logger = Logger::getRootLogger();

/* asi se usa el logger de debug (solo para debug) */
//$logger->debug("Hello World!");

/* asi se usa el logger de errores (se pone en los catch y se loguea la excepcion) */
//$logger->error("Error");

//require_once(__DIR__."/model/RolModel.php");
/*
$rolService = new RolService;

$rol = $rolService->getRolById(1);

echo $rol->id."\n".$rol->descripcion."\n";

$array = $rolService->getAllRoles();

var_dump($array);

$usuarioService = new UsuarioService;

*/
//var_dump($usuario->getRol());

// para probar el create quitar el if o poner 1 == 1

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

var_dump($usuarioService->getUsuarioById(1));

//$val = new ValidationHelper;

//echo $val->validateText("ger", 1, 10);

//$imagenService = new ImagenService;

//var_dump ($imagenService->getImagenById(4));
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
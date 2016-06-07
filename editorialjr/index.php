<?php

require_once(__DIR__."/service/UsuarioService.php");
require_once(__DIR__."/service/CiudadService.php");
require_once(__DIR__."/service/RolService.php");
require_once(__DIR__."/service/RegionService.php");
require_once(__DIR__."/service/PublicacionService.php");
require_once(__DIR__."/service/NumeroService.php");
require_once(__DIR__."/service/ImagenService.php");
require_once(__DIR__."/service/EstadoArticuloService.php");
require_once(__DIR__."/service/EstadoNumeroService.php");
require_once(__DIR__."/model/UsuarioModel.php");
require_once(__DIR__."/helpers/ValidationHelper.php");

/* Usar siempre solo este require para logger */
require_once(__DIR__."/helpers/LoggerHelper.php");

$service = new PublicacionService;

var_dump($service->getPublicacionById(1));

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


if(true){
	$publicacionModel = new PublicacionModel;
	$publicacionModel->id_usuario = 1;
	$publicacionModel->nombre = "publicacion1";
	$publicacionModel->destacado = "true";
	$publicacionModel->url_ultima_portada="asd.com.ar";
	$numeroModel = new NumeroModel;
	$numeroModel->id_estado_numero = 1;
	$numeroModel->url_portada = "dsadsa.com";
	$numeroModel->fe_erratas = null;
	$numeroModel->precio = 200;
	$publicacionService = new PublicacionService;
	try{
		$creado = $publicacionService->createPublicacionNumero($publicacionModel,$numeroModel);
	} catch (Exception $e){
		echo $e;
	}
	echo $creado;
	
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
		<div>
			<button id="btnObtenerCiudadesBsAs">Obtener ciudades de Bs As</button>
			<div id="resultadoCiudades"></div>
		</div>

	</body>
</html>
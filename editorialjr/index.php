<?php
require_once (__DIR__ . "/service/UsuarioService.php");
require_once (__DIR__ . "/service/CiudadService.php");
require_once (__DIR__ . "/service/RolService.php");
require_once (__DIR__ . "/service/RegionService.php");
require_once (__DIR__ . "/service/PublicacionService.php");
require_once (__DIR__ . "/service/NumeroService.php");
require_once (__DIR__ . "/service/ImagenService.php");
require_once (__DIR__ . "/service/EstadoArticuloService.php");
require_once (__DIR__ . "/service/EstadoNumeroService.php");
require_once (__DIR__ . "/model/UsuarioModel.php");
require_once (__DIR__ . "/helpers/ValidationHelper.php");
require_once (__DIR__ . "/common/Dates.php");

/* Usar siempre solo este require para logger */
require_once (__DIR__ . "/helpers/LoggerHelper.php");

$service = new PublicacionService ();

var_dump ( $service->getPublicacionById ( 1 ) );

$usuarioService = new UsuarioService ();

if (false) {
	$usuarioModel = new UsuarioModel ();
	$usuarioModel->email = "redactor@redactor.com";
	$usuarioModel->pass = "1234";
	$usuarioModel->nombre = "redactor";
	$usuarioModel->apellido = "jr";
	
	try {
		$creado = $usuarioService->createUsuario ( $usuarioModel );
	} catch ( Exception $e ) {
		echo $e;
	}
	echo "creado: $creado";
}

// agrega publicacion y numero corrobora los getter.

if (false) {
	$publicacionModel = new PublicacionModel ();
	$publicacionModel->id_usuario = _POST["id"];
	$publicacionModel->nombre = _POST["nombre"] ;
	$publicacionModel->destacado = "false";
	
	$numeroModel = new NumeroModel ();
	$numeroModel->id = null;
	$numeroModel->id_publicacion = "null";
	$numeroModel->id_estado_numero = 1;
	$numeroModel->url_portada = "unlam.com";
	$numeroModel->fe_erratas = "null";
	$numeroModel->precio = 120;
	$numeroModel->fecha_publicado = "null";
	
	$publicacionService = new PublicacionService ();
	// echo "".$publicacionModel->nombre;
	try {
		$creado = $publicacionService->createPublicacionNumero ( $publicacionModel, $numeroModel );
	} catch ( Exception $e ) {
		echo "error" . $e;
	}
	echo "creado: $creado";
	
	$numeroService = new NumeroService ();
	$arrayNumeroModel = $numeroService->getAllNumeros ( 14 );
	
	echo "ultima fecha publicada: " . $publicacionModel->getFechaUltimoNumero ();
	

}

?>


<!DOCTYPE html>
<html>
<head>
<title>Tp Final</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
</head>
<body>
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
	<div>
		<button id="btnGetAllPais">obtenerTodosLosPaises</button>
		<div id="resultadoPaises"></div>
	</div>
	<div>
		<button id="btnObtenerRegiones">obtenerRegionesPaisID2</button>
		<div id="resultadoRegiones"></div>
	</div>
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/editorialjr.js"></script>
</body>
</html>
<?php

require_once(__DIR__."/service/UsuarioService.php");
require_once(__DIR__."/service/RolService.php");
//require_once(__DIR__."/model/UsuarioModel.php");
//require_once(__DIR__."/model/RolModel.php");
/*
$usuario = UsuarioService::getUsuarioByEmail('admin@editorialjr.com');

$rol = RolService::getRolById(1);

echo $rol->id."\n".$rol->descripcion."\n";

$array = RolService::getAllRoles();

var_dump($array);
*/
//var_dump($usuario->getRol());
 
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
				<?php echo $usuario->email ?>
			</p>
		</div>
		<div>
			<button id="btnTest">Test Ajax</button>
			<span id="spnTestAjax"></span>
		</div>
	</body>
</html>
<?php

require_once(__DIR__."/service/UsuarioService.php");

$usuarioService = new UsuarioService;
$usuario = $usuarioService->getUsuarioById(1);

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Tp Final</title>
	</head>
	<body>
		<div>
			<p>
				Usuario:
				<?php echo $usuario["nombre"] ?>
			</p>
		</div>
	</body>
</html>
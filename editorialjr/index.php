<?php

require_once(__DIR__."/service/UsuarioService.php");
require_once(__DIR__."/model/UsuarioModel.php");

$usuario = UsuarioService::getUsuarioByEmail('admin@editorialjr.com');

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
				<?php echo $usuario->email ?>
			</p>
		</div>
	</body>
</html>
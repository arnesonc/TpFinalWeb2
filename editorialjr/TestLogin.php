<?php
	require_once (__DIR__ . "/service/UsuarioService.php");
	$service = new UsuarioService();

	if($service->checkUserAndPass("admin@editorialjr.com","admin")) {
		header('Location: ./admin-cms.php');
	}
	else {
		header('Location: ./admin-login.php');
	}
?>

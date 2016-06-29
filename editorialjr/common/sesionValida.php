<?php
	session_start();

	if( !isset($_SESSION["session"]["login"]) ){
		session_destroy();
		header("location:admin-login.php");
	}

	if( !$_SESSION["session"]["login"] || $_SESSION["session"]["login"] != "ok"){
		session_destroy();
		header("location:admin-login.php");
	}
?>

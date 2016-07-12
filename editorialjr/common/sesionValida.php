<?php //ob_start();
	session_start();

	if( !isset($_SESSION["session"]["login"]) ){
		session_destroy();
		header("location:admin-login.php");
        exit();
	}

	if( !$_SESSION["session"]["login"] || $_SESSION["session"]["login"] != "ok"){
		session_destroy();
		header("location:admin-login.php");
        exit();
	}
?>

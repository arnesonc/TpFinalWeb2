<?php
	session_start();

	if($_SESSION['session']['rol'] != null){
	    header("location:admin-cms.php");
	    exit();
	}

/*
	if( !isset($_SESSION["session"]["login"]) ){
		session_destroy();
		header("location:index.php");
	}

	if( !$_SESSION["session"]["login"] || $_SESSION["session"]["login"] != "ok"){
		session_destroy();
		header("location:index.php");
	}*/
?>

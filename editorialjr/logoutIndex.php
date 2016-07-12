<?php
	require_once(__DIR__."/common/sesionValidaIndex.php");

	if(isset($_SESSION["session"]) && $_SESSION["session"]["login"] == "ok"){

		$_SESSION["session"] = null;
		session_destroy();
		header("location:index.php");
	}else{
        header("location:index.php");
    }
?>

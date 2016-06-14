<?php 
	session_start();
	echo "adios ".$_SESSION['session']['nombre']."!";
	session_destroy();
?>
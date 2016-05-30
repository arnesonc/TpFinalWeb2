<?php

require_once(__DIR__."/TestAjax.php");

/* PHP para probar un request de ajax. La idea es que o se haga una clase por cada service al que se quiera consultar o se genera la lógica para saber a que service llamar (un switch por ejemplo). Es dificil manejar los parametros en caso del switch */

$datos = $_POST["datos"];

$result = TestAjax::metodo($datos);

die($result);

?>
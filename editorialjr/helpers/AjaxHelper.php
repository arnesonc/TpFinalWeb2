<?php

require_once(__DIR__."/../common/TestAjax.php");
/* PHP para probar un request de ajax. La idea es que o se haga una clase por cada service al que se quiera consultar o se genera la lógica para saber a que service llamar (un switch por ejemplo). Es dificil manejar los parametros en caso del switch */
$testAjax = new TestAjax;
$metodo = $_POST["metodo"];
$datos = $_POST["datos"];
switch($metodo){
	case "getAlgo":
		$result = $testAjax->metodo($datos);
		break;
	default:
		echo "Método no existente en el switch";
}
echo $result;
?>
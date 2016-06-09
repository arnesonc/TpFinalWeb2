<?php
require_once(__DIR__."/../service/ClienteService.php");
require_once(__DIR__."/../model/ClienteModel.php");

$metodo = $_POST["metodo"];

$result = null;

switch($metodo){
	case "createCliente":
		
		$clienteService = new ClienteService;
		$clienteModel = new ClienteModel;

		$clienteModel->email=$_POST["email"];
		$clienteModel->pass=$_POST["pass"];
		$clienteModel->nombre=$_POST["nombre"];
		$clienteModel->apellido=$_POST["apellido"];
		$clienteModel->id_ciudad=$_POST["id_ciudad"];
		$clienteModel->calle=$_POST["calle"];
		$clienteModel->numero_calle=$_POST["numero_calle"];
		$clienteModel->codigo_postal=$_POST["codigo_postal"];
		$clienteModel->piso=$_POST["piso"];
		$clienteModel->departamento=$_POST["departamento"];
		$clienteModel->detalle_direccion=$_POST["detalle_direccion"];
		
		$result = $clienteService->createCliente($clienteModel);
		break;
	default:
		echo "Método inexistente en el switch de ClienteAjaxHelper.php";
}

echo json_encode($result);
?>
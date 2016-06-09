<?php
require_once(__DIR__."/../service/ClienteService.php");
require_once(__DIR__."/../model/ClienteModel.php");

$metodo = $_POST["metodo"];

$result = null;

switch($metodo){
	case "createCliente":
		
		$clienteService = new ClienteService;
		$clienteModel = new ClienteModel;
		
		$clienteModel->nombre=$_POST["nombre"];
		$clienteModel->apellido=$_POST["apellido"];
		$clienteModel->email=$_POST["email"];
		$clienteModel->pass=$_POST["pass"];
		$clienteModel->calle=$_POST["calle"];
		$clienteModel->id_estado_cliente=$_POST["id_estado_cliente"];
		$clienteModel->piso=$_POST["piso"];
		$clienteModel->id_ciudad=$_POST["id_ciudad"];
		$clienteModel->detalle_direccion=$_POST["detalle_direccion"];
		$clienteModel->codigo_postal=$_POST["codigo_postal"];
		$clienteModel->codigo_postal=$_POST["codigo_postal"];
		
		$result = $clienteService->createCliente($clienteModel);
		
		break;
	default:
		echo "Método inexistente en el switch de ClienteAjaxHelper.php";
}

echo json_encode($result);
?>
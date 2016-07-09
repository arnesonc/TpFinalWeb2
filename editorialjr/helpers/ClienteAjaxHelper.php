<?php
require_once(__DIR__ . "/../service/ClienteService.php");
require_once(__DIR__ . "/../model/ClienteModel.php");

$metodo = $_POST["metodo"];

$result = null;

$clienteService = new ClienteService;

switch ($metodo) {
    case "createCliente":
        $clienteModel = new ClienteModel;
        $clienteModel->email = $_POST["email"];
        $clienteModel->pass = $_POST["pass"];
        $clienteModel->nombre = $_POST["nombre"];
        $clienteModel->apellido = $_POST["apellido"];
        $clienteModel->id_ciudad = $_POST["id_ciudad"];
        $clienteModel->calle = $_POST["calle"];
        $clienteModel->numero_calle = $_POST["numero_calle"];
        $clienteModel->codigo_postal = $_POST["codigo_postal"];
        $clienteModel->piso = isset($_POST["piso"]) && trim($_POST["piso"]) != "" ? $_POST["piso"] : null;
        $clienteModel->departamento = isset($_POST["departamento"]) && trim($_POST["departamento"]) != "" ? $_POST["departamento"] : null;
        $clienteModel->detalle_direccion = isset($_POST["detalle_direccion"]) && trim($_POST["detalle_direccion"]) != "" ? $_POST["detalle_direccion"] : null;

        $result = $clienteService->createCliente($clienteModel);
        break;
    case "getAllClientes":
        $result = $clienteService->getAllClientes();
        break;
    case "checkUserAndPass":
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $result = $clienteService->checkUserAndPass($email, $pass);
        break;
    default:
        echo "Método inexistente en el switch de ClienteAjaxHelper.php";
}

echo json_encode($result);
?>

<?php
require_once(__DIR__."/../common/lib/mercadopago.php");
require_once(__DIR__."/PublicacionService.php");
require_once(__DIR__ . "/../helpers/LoggerHelper.php");

//$mp = new MP ("CLIENT_ID", "CLIENT_SECRET");
class MercadoPagoService {

	public function pagar($idPublicacion,$cantidad,$operacion){
		$mp = new MP ("8940367240260846", "JcSR2T3HF3kSgslE5JE49AXCxKZzWH3E");
		$publicacionService = new PublicacionService();
		$PublicacionModel = $publicacionService->getPublicacionById($idPublicacion);
		$precio = $publicacionService->getLastPrecio($idPublicacion);

	if($cantidad == 1){ //FIXME:hardcode
		$titulo = "Compra de un numero: '".$PublicacionModel->nombre."'";
	}
	if($cantidad == 6){ //FIXME:hardcode
			$titulo = "Suscripción a revista '".$PublicacionModel->nombre."' por ".$cantidad." meses.";
	}

		$preference_data = array(
			"items" => array(
				array(
					"title" => $titulo,
					"quantity" => $cantidad,
					"currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
					"unit_price" => ($precio * 1)
				)
			)
		);

		$preference = $mp->create_preference($preference_data);
		return ($preference["response"]["init_point"]);
	}
}
?>

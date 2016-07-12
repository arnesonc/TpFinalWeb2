<?php
require_once(__DIR__."/../common/lib/mercadopago.php");
require_once(__DIR__."/PublicacionService.php");
require_once(__DIR__ . "/../helpers/LoggerHelper.php");

//$mp = new MP ("CLIENT_ID", "CLIENT_SECRET");
class MercadoPagoService {

	public function pagar($idPublicacion,$cantidad){
		$mp = new MP ("8940367240260846", "JcSR2T3HF3kSgslE5JE49AXCxKZzWH3E");
		$publicacionService = new PublicacionService();
		$PublicacionModel = $publicacionService->getPublicacionById($idPublicacion);
		$precio = $publicacionService->getLastPrecio($idPublicacion);

		$preference_data = array(
			"items" => array(
				array(
					"title" => "Suscripción a revista '".$PublicacionModel->nombre."' por 6 meses.",
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

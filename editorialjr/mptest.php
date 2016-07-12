<?php
require_once(__DIR__."/common/lib/mercadopago.php");
//$mp = new MP ("CLIENT_ID", "CLIENT_SECRET");
$mp = new MP ("8940367240260846", "JcSR2T3HF3kSgslE5JE49AXCxKZzWH3E");

$preference_data = array(
	"items" => array(
		array(
			"title" => "Multicolor kite",
			"quantity" => 1,
			"currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
			"unit_price" => 10.00
		)
	)
);

$preference = $mp->create_preference($preference_data);
echo ($preference["response"]["init_point"]);
?>

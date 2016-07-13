<?php

require_once(__DIR__ . "/common/phpqrcode/qrlib.php");

$info = "Sin información";

if(isset($_GET["info"])){
    $info = $_GET["info"];
}

QRcode::png($info);
?>
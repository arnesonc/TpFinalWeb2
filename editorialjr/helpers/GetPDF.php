<?php

require_once(__DIR__ . "/../common/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$contentPDF = $_POST["contentPDF"];
$namePDF = $_POST["namePDF"];

// instantiate and use the dompdf class
$dompdf = new Dompdf;
$dompdf->loadHtml($contentPDF);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
$dompdf->set_option('isHtml5ParserEnabled', true);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('editorial-jr-reporte-' . $namePDF);

?>

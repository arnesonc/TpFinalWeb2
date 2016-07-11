<?php
require_once(__DIR__ . "/sesionValida.php");

if($_SESSION['session']['rol'] != '1'){
    header("location:admin-cms.php");
    exit();
}
?>
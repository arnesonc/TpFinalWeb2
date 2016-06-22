<?php
session_start();

$result = null;
if ($_SESSION['session']['login'] == 'ok' ){
    $result = $_SESSION['session']['id'];
    echo json_encode($result);
}else
    echo "ERROR DE SESSION";
?>
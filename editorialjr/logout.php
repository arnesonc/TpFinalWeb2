<?php
require_once(__DIR__ . "/common/sesionValida.php");

if (isset($_SESSION["session"]) && $_SESSION["session"]["login"] == "ok") {

    $_SESSION["session"] = null;
    session_destroy();
    header("location:index.php");
} else {
    header("location:admin-login.php");
}

?>

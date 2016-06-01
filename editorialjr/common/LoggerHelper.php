<?php

/**
 *  Este PHP solo tiene los require de lo necesario para usar log4php.
 *  De esta manera cuando queremos usar el logger solo requerimos este PHP
 */

require_once(__DIR__."/../config/log4php/src/main/php/Logger.php");
Logger::configure(dirname(__FILE__).'/../config/log4php.properties');

?>
<?php

require_once(__DIR__."/../service/EstadoNumeroService.php");
require_once(__DIR__."/../service/PublicacionService.php");
require_once(__DIR__."/../service/NumeroService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class NumeroModel{
	public $id;
	public $id_publicacion;
	public $id_estado_numero;
	public $url_portada;
	public $fe_erratas;
	public $precio;
	public $fecha_publicado;
	public $numero_revista;
	public $nombre_publicacion;
	public $fecha_de_compra;
	private $estado_numero;
	private $publicacion;

	/**
	 * Obtiene un objeto EstadoNumero, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getEstadoNumero(){

		if(is_null($this->estado_numero)){
			$estadoNumeroService = new EstadoNumeroService;

			try {

				$this->estado_Numero = $estadoNumeroService->getEstadoNumeroById($this->id_estado_numero);

			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}

		return $this->estado_numero;
	}

	/**
	 * Obtiene un objeto Publicacion, si lo tiene en memoria lo devuelve, si no, lo va a buscar a la base de datos
	 * */
	public function getPublicacion(){

		if(is_null($this->publicacion)){
			$publicacionService = new PublicacionService;

			try {

				$this->publicacion = $publicacionService->getPublicacionById($this->id_publicacion);

			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
		$this->nombre_publicacion = $this->publicacion->nombre;
		return $this->publicacion;
	}

	//FUNCION QUE OBTIENE EL PATH DE ARCHIVOS DE UN NUMERO.

	public function getPath(){
		$numeroService = new NumeroService;
		$this->getPublicacion();
		$pathname = $GLOBALS ['app_config'] ["url_imagen"] . $this->publicacion->id . "_" . $this->publicacion->nombre . "/numero" . $this->numero_revista."/";

		return $pathname;
	}
}

?>

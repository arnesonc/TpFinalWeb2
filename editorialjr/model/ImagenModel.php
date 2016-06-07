<?php

require_once(__DIR__."/../service/ArticuloService.php");
require_once(__DIR__."/../helpers/LoggerHelper.php");

class ImagenModel{
	
	public $id;
	public $id_articulo;
	public $url;

	private $articulo;
	
	/**
	 * Obtiene un objeto ArticuloModel, si lo tiene en memoria devuelve ese, si no, lo va a buscar a la base de datos
	 * */
	public function getArticulo(){
	
		if(is_null($this->articulo)){
			$articuloService = new ArticuloService;
				
			try {
	
				$this->articulo = $articuloService->getArticuloById($this->id_articulo);
	
			}catch(Exeption $e){
				$logger = Logger::getRootLogger();
				$logger->error($e);
				return null;
			}
		}
	
		return $this->articulo;
	}
}
?>
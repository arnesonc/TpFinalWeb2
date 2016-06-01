<?php
require_once(__DIR__."/../common/DataAccess.php");
require_once(__DIR__."/../model/RolModel.php");

class ImagenService{
	
	private $dataAccess = null;
	private $mensaje = "ha ocurrido un error.";
	
	public function __construct(){
		$this->dataAccess = new DataAccess;
	}
	
	public function getImagenById($ImagenId){
		
	}
}
?>
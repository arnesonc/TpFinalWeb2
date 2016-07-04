<?php

require_once __DIR__.'/../common/DataAccess.php';
require_once __DIR__.'/../common/AppConfig.php';
require_once __DIR__.'/../model/PublicacionModel.php';
require_once __DIR__.'/../helpers/LoggerHelper.php';
require_once __DIR__.'/../helpers/ValidationHelper.php';
require_once __DIR__.'/../model/NumeroModel.php';

class PublicacionService
{
    private $dataAccess = null;
    public function __construct()
    {
        $this->dataAccess = new DataAccess();
    }

    /**
     * Obtiene una PublicacionModel por su id.
     */
    public function getPublicacionById($id)
    {
        $sql = "SELECT id,
				    id_usuario,
				    nombre,
				    fecha_utlimo_numero,
				    url_ultima_portada,
				    destacado
				FROM publicacion
				WHERE id = $id;";

        try {
            $publicacionDB = $this->dataAccess->getOneResult($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return;
        }

        return $this->convertPublicacionDBToPublicacionModel($publicacionDB);
    }

    /**
     * Convierte un publicacion de la base de datos en un objeto PublicacionModel y lo devuelve.
     */
    private function convertPublicacionDBToPublicacionModel($publicacionDB)
    {

        /* Convierto el resultado de la BD a un objeto modelado */
        $publicacionModel = new PublicacionModel();
        $publicacionModel->id = $publicacionDB ['id'];
        $publicacionModel->id_usuario = $publicacionDB ['id_usuario'];
        $publicacionModel->nombre = utf8_encode($publicacionDB ['nombre']);
        $publicacionModel->fecha_utlimo_numero = $publicacionDB ['fecha_utlimo_numero'];
        $publicacionModel->url_ultima_portada = $publicacionDB ['url_ultima_portada'];
        $publicacionModel->destacado = $publicacionDB ['destacado'];

        return $publicacionModel;
    }

    /*
     * Obtiene todas las publicaciones de la base de datos
     */
    public function getAllPublicaciones()
    {
        $sql = ' SELECT id,
    			id_usuario,
   				nombre,
    			fecha_utlimo_numero,
    			url_ultima_portada,
    			destacado
				FROM publicacion;
				';

        try {
            $publicacionDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return;
        }

        $arrayPublicacionModel = array();

        foreach ($publicacionDBArray as $publicacionDB) {
            $publicacionModel = $this->convertPublicacionDBToPublicacionModel($publicacionDB);

            $arrayPublicacionModel [] = $publicacionModel;
        }

        return $arrayPublicacionModel;
    }

    /**
     * Valida un objeto Publicacion Model.
     */
    private function validatePublicacion($publicacionModel)
    {
        $validationHelper = new ValidationHelper();

        /*
        if ($validationHelper->validateNull ( $publicacionModel->id_usuario ) || $validationHelper->validateIsSet ( $publicacionModel->id_usuario ) || ! $validationHelper->validateNumber ( $publicacionModel->id_usuario )) {
            return "Debe seleccionar un editor para la publicacion";
        }
        */ //TODO: validar que el id_usuario sea correcto, el id usuario puede ser null.

        if ($validationHelper->validateNull($publicacionModel->nombre) || !$validationHelper->validateIsSet($publicacionModel->nombre) || !$validationHelper->validateText($publicacionModel->nombre, 1, 50)) {
            return 'El nombre de la publicacion es obligatorio y debe contener entre 1 y 50 caracteres.';
        }

        if ($validationHelper->validateNull($publicacionModel->nombre) && $validationHelper->validateIsSet($publicacionModel->nombre) && !$validationHelper->validateText($publicacionModel->nombre, 5, 200)) {
            return 'Se debe especificar la url de la ultima portada';
        }

        if (!isset($publicacionModel->destacado) || !$validationHelper->validateBoolean($publicacionModel->destacado)) {
            return 'No se conoce el estado de Publicacion destacada';
        }

        return '';
    }

    public function createPublicacionNumeroParametros($id_usuario, $nombre, $destacado, $precio)
    {
        $publicacionModel = new PublicacionModel();
        $publicacionModel->id_usuario = $id_usuario;
        $publicacionModel->nombre = $nombre;
        $publicacionModel->destacado = $destacado;

        $numeroModel = new NumeroModel();
        $numeroModel->id_estado_numero = 1;
        $numeroModel->precio = $precio;

        try {
            $succes = $this->createPublicacionNumero($publicacionModel, $numeroModel);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return $e;
        }

        return $succes;
    }

    /*
     * Crea una publicacion obligando a crear un numero
     */
    public function createPublicacionNumero($publicacionModel, $numeroModel)
    {
        $messagePublicacion = $this->validatePublicacion($publicacionModel);

        if (!empty($messagePublicacion)) {
            $logger = Logger::getRootLogger();
            $logger->error($messagePublicacion);

            return $messagePublicacion;
        }

        $numeroService = new NumeroService();
        $messageNumero = $numeroService->validateNumero($numeroModel);

        if (!empty($messageNumero)) {
            $logger = Logger::getRootLogger();
            $logger->error($messageNumero);

            return $messageNumero;
        }

        try {
            $publicacionModel->url_ultima_portada = $numeroModel->url_portada;
            $idPublicacion = $this->insertPublicacion($publicacionModel);
            $numeroModel->id_publicacion = $idPublicacion;
            $numeroService->createNumero($numeroModel);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return $e;
        }

        return true;
    }

    // TODO: se puede agregar crear publicacion por parametros.

    /**
     * Inserta una nueva seccion, si tuvo exito devuelve el id de la publicacion
     * caso contrario devuelve falso.
     */
    private function insertPublicacion($PublicacionModel)
    {
        $sql = " INSERT INTO publicacion
		(id,
    	id_usuario,
   		nombre,
    	destacado
		)
		VALUES
		(null,
		$PublicacionModel->id_usuario,
		'$PublicacionModel->nombre',
		'$PublicacionModel->destacado'
		);
		";
        try {
            // Ejecuta el insert en la BD
            $idPublicacion = $this->dataAccess->execute($sql, true);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return false;
        }

        return $idPublicacion;
    }

    public function getLastFecha($id_publicacion)
    {
        $sql = "SELECT
				MAX(fecha_publicado) as fecha_publicado
				FROM numero WHERE id_publicacion = $id_publicacion;";
        //busca los numeros de una publicacion en la bd
        try {
            $ultimaFechaDePublicacionDadaDB = $this->dataAccess->getOneResult($sql)['fecha_publicado'];
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return;
        }

        return $ultimaFechaDePublicacionDadaDB;
    }

    public function updatePublicacionParameters($id, $nombre, $destacado)
    {
        $publicacionModel = new PublicacionModel();
        $publicacionModel->id = $id;
        $publicacionModel->nombre = $nombre;
        $publicacionModel->destacado = $destacado;

        $message = $this->validatePublicacion($publicacionModel, false);

        // Si esta vacio, no hay mensaje de error por lo tanto es válido
        if (empty($message)) {
            $result = $this->updatePublicacion($publicacionModel);
        } else {
            // En caso de ser invalido devuelve un mensaje de validacion
            $result = $message;
            $logger = Logger::getRootLogger();
            $logger->error($message);
        }

        return $result;
    }

    private function updatePublicacion($publicacionModel)
    {
        $sql = " UPDATE publicacion
		SET
		nombre = '$publicacionModel->nombre',
		destacado = '$publicacionModel->destacado'
		WHERE id = $publicacionModel->id;";

        try {
            // Ejecuta el insert en la BD
            $this->dataAccess->execute($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return false;
        }

        return true;
    }

    public function getNumberOfPublications()
    {
        $sql = 'SELECT count(*) publicaciones
						FROM publicacion;';

        try {
            $numeroPublicaciones = $this->dataAccess->getOneResult($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return;
        }

        return $numeroPublicaciones['publicaciones'];
    }

    public function addUltimaPortadaDelUltimoNumero($url_ultima_portada,$id_publicacion){
    	$sql = "UPDATE publicacion
					SET url_ultima_portada= '$url_ultima_portada',
					fecha_utlimo_numero = DATE(NOW())
					WHERE id = $id_publicacion;";
    	
    	try {
    		// Ejecuta el insert en la BD
    		$this->dataAccess->execute($sql);
    	} catch (Exception $e) {
    		$logger = Logger::getRootLogger();
    		$logger->error($e);
    	
    		return false;
    	}
    	 return true;
    }
    
    public function getPublicacionesPaginado($offset, $itemsPorPagina)
    {
        $sql = "SELECT id,
					    id_usuario,
					    nombre,
					    fecha_utlimo_numero,
					    url_ultima_portada,
					    destacado
					FROM publicacion
					LIMIT $offset, $itemsPorPagina;";

        try {
            $publicacionDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return;
        }

        $arrayPublicacionModel = array();

        foreach ($publicacionDBArray as $publicacionDB) {
            $publicacionModel = $this->convertPublicacionDBToPublicacionModel($publicacionDB);

            $arrayPublicacionModel [] = $publicacionModel;
        }

        return $arrayPublicacionModel;
    }
}

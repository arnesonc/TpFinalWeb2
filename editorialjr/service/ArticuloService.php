<?php
require_once(__DIR__ . "/../common/DataAccess.php");
require_once(__DIR__ . "/../model/ArticuloModel.php");
require_once(__DIR__ . "/../helpers/LoggerHelper.php");
require_once(__DIR__ . "/../helpers/ValidationHelper.php");
session_start(); //para todos los metodos que usen variables de session

class ArticuloService
{
    private $dataAccess = null;
    private $validationHelper = null;

    public function __construct()
    {
        $this->dataAccess = new DataAccess ();
        $this->validationHelper = new ValidationHelper ();
    }

    /**
     * Obtiene un ArticuloModel por su id
     */
    public function getArticuloById($id)
    {
        $sql = "SELECT id,
			    id_seccion,
			    id_usuario,
			    id_estado_articulo,
			    titulo,
			    latitud,
			    longitud,
			    fecha_cierre,
			    copete,
			    url_contenido,
			    contenido_adicional,
				id_numero
			FROM articulo
			WHERE id = $id;";

        try {

            $articuloDB = $this->dataAccess->getOneResult($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        return $this->convertCiudadDBToCiudadModel($articuloDB);
    }

    /**
     * Obtiene una lista de ArticuloModel por su id_seccion
     */
    public function getAllArticulosByIdSeccion($idSeccion)
    {
        $sql = "SELECT id,
		id_seccion,
		id_usuario,
		id_estado_articulo,
		titulo,
		latitud,
		longitud,
		fecha_cierre,
		copete,
		url_contenido,
		contenido_adicional,
		id_numero
		FROM articulo
		WHERE id_seccion = $idSeccion;";

        try {

            $articuloDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        $arrayArticuloModel = array();

        foreach ($articuloDBArray as $articuloDB) {

            $articuloModel = $this->convertArticuloDBToArticuloModel($articuloDB);

            $arrayArticuloModel [] = $articuloModel;
        }

        return $arrayArticuloModel;
    }

//TODO: Obtiene una lista de articulos por id numero

    public function getAllArticulosByIdNumero($idNumero)
    {
        $sql = "SELECT id,
		id_seccion,
		id_usuario,
		id_estado_articulo,
		titulo,
		latitud,
		longitud,
		fecha_cierre,
		copete,
		url_contenido,
		contenido_adicional,
		id_numero
		FROM articulo
		WHERE id_numero = $idNumero;";

        try {

            $articuloDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        $arrayArticuloModel = array();

        foreach ($articuloDBArray as $articuloDB) {

            $articuloModel = $this->convertArticuloDBToArticuloModel($articuloDB);

            $arrayArticuloModel [] = $articuloModel;
        }

        return $arrayArticuloModel;
    }

    /**
     * Obtiene una lista de ArticuloModel por su id_usuario
     */
    public function getAllArticulosByIdUsuario($idUsuario)
    {
        $sql = "SELECT id,
		id_seccion,
		id_usuario,
		id_estado_articulo,
		titulo,
		latitud,
		longitud,
		fecha_cierre,
		copete,
		url_contenido,
		contenido_adicional,
		id_numero
		FROM articulo
		WHERE id_usuario = $idUsuario;";

        try {

            $articuloDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        $arrayArticuloModel = array();

        foreach ($articuloDBArray as $articuloDB) {

            $articuloModel = $this->convertArticuloDBToArticuloModel($articuloDB);

            $arrayArticuloModel [] = $articuloModel;
        }

        return $arrayArticuloModel;
    }

    /**
     * Obtiene una lista de ArticuloModel
     */
    public function getAllArticulos()
    {
        $sql = "SELECT id,
		id_seccion,
		id_usuario,
		id_estado_articulo,
		titulo,
		latitud,
		longitud,
		fecha_cierre,
		copete,
		url_contenido,
		contenido_adicional,
		id_numero
		FROM articulo;";

        try {

            $articuloDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        $arrayArticuloModel = array();

        foreach ($articuloDBArray as $articuloDB) {

            $articuloModel = $this->convertArticuloDBToArticuloModel($articuloDB);

            $arrayArticuloModel [] = $articuloModel;
        }

        return $arrayArticuloModel;
    }

    /**
     * Obtiene una lista de ArticuloModel que esten en borrador
     */
    public function getAllArticulosDraft()
    {
        $draft = 1;
        $sql = "SELECT id,
		id_seccion,
		id_usuario,
		id_estado_articulo,
		titulo,
		latitud,
		longitud,
		fecha_cierre,
		copete,
		url_contenido,
		contenido_adicional,
		id_numero
		FROM articulo
		WHERE id_estado_articulo = $draft;";

        try {

            $articuloDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        $arrayArticuloModel = array();

        foreach ($articuloDBArray as $articuloDB) {

            $articuloModel = $this->convertArticuloDBToArticuloModel($articuloDB);

            $arrayArticuloModel [] = $articuloModel;
        }

        return $arrayArticuloModel;
    }

    /*-----------------------------------------------------------------------------------------------------------------*/
    public function getAllArticulosFromNumByUser($idUsuario, $idNumero)
    {


        if ($_SESSION['session']['rol'] == 1) {
            $sql = "SELECT id,
			id_seccion,
			id_usuario,
			id_estado_articulo,
			titulo,
			latitud,
			longitud,
			fecha_cierre,
			copete,
			url_contenido,
			contenido_adicional,
			id_numero
			FROM articulo
			WHERE id_numero = $idNumero;";
        } else {
            $sql = "SELECT id,
			id_seccion,
			id_usuario,
			id_estado_articulo,
			titulo,
			latitud,
			longitud,
			fecha_cierre,
			copete,
			url_contenido,
			contenido_adicional,
			id_numero
			FROM articulo
			WHERE id_usuario = $idUsuario AND id_numero = $idNumero;";
        }

        try {

            $articuloDBArray = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        $arrayArticuloModel = array();

        foreach ($articuloDBArray as $articuloDB) {

            $articuloModel = $this->convertArticuloDBToArticuloModel($articuloDB);

            $arrayArticuloModel [] = $articuloModel;
        }

        return $arrayArticuloModel;
    }

    /*-----------------------------------------------------------------------------------------------------------------*/

    /*
      Convierte un articulo de la base de datos en un objeto ArticuloModel y lo devuelve
     */
    private function convertArticuloDBToArticuloModel($articuloDB)
    {

        /* Convierto el resultado de la BD a un objeto modelado */
        $articuloModel = new ArticuloModel ();
        $articuloModel->id = $articuloDB ["id"];
        $articuloModel->id_seccion = $articuloDB ["id_seccion"];
        $articuloModel->id_usuario = $articuloDB ["id_usuario"];
        $articuloModel->id_estado_articulo = $articuloDB ["id_estado_articulo"];
        $articuloModel->titulo = utf8_encode($articuloDB ["titulo"]);
        $articuloModel->latitud = $articuloDB ["latitud"];
        $articuloModel->longitud = $articuloDB ["longitud"];
        $articuloModel->fecha_cierre = $articuloDB ["fecha_cierre"];
        $articuloModel->copete = utf8_encode($articuloDB ["copete"]);
        $articuloModel->url_contenido = $articuloDB ["url_contenido"];
        $articuloModel->contenido_adicional = utf8_encode($articuloDB ["contenido_adicional"]);
        $articuloModel->id_numero = $articuloDB ["id_numero"];
        return $articuloModel;
    }

    /*
      Crea un articulo a partir de un objeto ArticuloModel si pasa las validaciones, caso contrario devuelve
      el mensaje de validacion correspondiente
     */

    public function createArticulo($articuloModel)
    {
        $message = $this->validateArticulo($articuloModel);

        // Si esta vacio, no hay mensaje de error por lo tanto es válido
        if (empty ($message)) {

            $result = $this->insertArticulo($articuloModel);
        } else {
            // En caso de ser invalido devuelve un mensaje de validacion
            $result = $message;
        }
      
        return $result;
    }

    /*
      Crea un articulo a partir de los datos parametizados (por separado)
     */

    public function createArticuloParametros($id_seccion, $id_usuario, $id_estado_articulo, $titulo, $latitud, $longitud, $fecha_cierre, $copete, $url_contenido, $contenido_adicional, $id_numero)
    {
        $articuloModel = new ArticuloModel ();
        $articuloModel->id_seccion = $id_seccion;
        $articuloModel->id_usuario = $id_usuario;
        $articuloModel->id_estado_articulo = $id_estado_articulo;
        $articuloModel->titulo = $titulo;
        $articuloModel->latitud = $latitud;
        $articuloModel->longitud = $longitud;
        $articuloModel->fecha_cierre = null;
        $articuloModel->copete = $copete;
        $articuloModel->url_contenido = $url_contenido;
        $articuloModel->contenido_adicional = $contenido_adicional;
        $articuloModel->id_numero = $id_numero;
        return $this->createArticulo($articuloModel);
    }

    /*
      Valida un objeto ArticuloModel
     */
    private function validateArticulo($articuloModel)
    {
        if ($this->validationHelper->validateNull($articuloModel->id_seccion) || !$this->validationHelper->validateIsSet($articuloModel->id_seccion) || !$this->validationHelper->validateNumber($articuloModel->id_seccion)) {
            return "Debe selecionar al menos una sección.";
        }

        if ($this->validationHelper->validateNull($articuloModel->id_usuario) || !$this->validationHelper->validateIsSet($articuloModel->id_usuario) || !$this->validationHelper->validateNumber($articuloModel->id_usuario)) {
            return "Debe selecionar un usuario propietario del artículo.";
        }

        if ($this->validationHelper->validateNull($articuloModel->id_estado_articulo) || !$this->validationHelper->validateIsSet($articuloModel->id_estado_articulo) || !$this->validationHelper->validateNumber($articuloModel->id_estado_articulo)) {
            return "Debe selecionar el estado del artículo.";
        }

        if ($this->validationHelper->validateNull($articuloModel->titulo) && !$this->validationHelper->validateText($articuloModel->titulo, 1, 100)) {
            return "El título no es válido. Debe poseer como máximo 100 caracteres.";
        }

        if (!$this->validationHelper->validateNull($articuloModel->latitud) && !$this->validationHelper->validateText($articuloModel->latitud, 1, 100)) {
            return "La latitud no es válida. Debe poseer como máximo 100 caracteres.";
        }

        if (!$this->validationHelper->validateNull($articuloModel->longitud) && !$this->validationHelper->validateText($articuloModel->longitud, 1, 100)) {
            return "La longitud no es válida. Debe poseer como máximo 100 caracteres.";
        }

        if (!$this->validationHelper->validateNull($articuloModel->copete) && !$this->validationHelper->validateText($articuloModel->copete, 1, 200)) {
            return "El copete no es válido. Debe poseer como máximo 200 caracteres.";
        }

        if (!$this->validationHelper->validateNull($articuloModel->url_contenido) && !$this->validationHelper->validateText($articuloModel->url_contenido, 1, 4000)) {
            return "La url del contenido no es válida. Debe poseer como máximo 100 caracteres.";
        }

        if (!$this->validationHelper->validateNull($articuloModel->contenido_adicional) && !$this->validationHelper->validateText($articuloModel->contenido_adicional, 1, 1000)) {
            return "El contenido adicional no es válido. Debe poseer como máximo 1000 caracteres.";
        }

        return "";
    }

    /*
      Inserta un nuevo articulo a partir de un objeto ArticuloModel, si tuvo exito devuelve verdadero
      caso contrario devuelve falso
     */
    private function insertArticulo($articuloModel)
    {

        //si el campo es null el sql lo coloca null, caso contraro inserta el valor con las 'quotes' correspondientes.
        $latitud = is_null($articuloModel->latitud) ? null : "'$articuloModel->latitud'";
        $longitud = is_null($articuloModel->longitud) ? null : "'$articuloModel->longitud'";
        $copete = is_null($articuloModel->copete) ? null : "'$articuloModel->copete'";
        $url_contenido = is_null($articuloModel->url_contenido) ? null : "'$articuloModel->url_contenido'";
        $contenido_adicional = is_null($articuloModel->contenido_adicional) ? null : "'$articuloModel->contenido_adicional'";

        $sql = " INSERT INTO articulo
				(id_seccion,
				id_usuario,
				id_estado_articulo,
				titulo,
				latitud,
				longitud,
				fecha_cierre,
				copete,
				url_contenido,
				contenido_adicional,
				id_numero)
				VALUES
				($articuloModel->id_seccion,
				$articuloModel->id_usuario,
				$articuloModel->id_estado_articulo,
				'$articuloModel->titulo',
				$latitud,
				$longitud,
				null,
				$copete,
				$url_contenido,
				$contenido_adicional,
				$articuloModel->id_numero);";

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

    /**
     * Actualiza un cliente a partir de los datos parametizados (por separado)
     */
    public function updateArticuloParametros($id, $id_seccion, $id_usuario, $id_estado_articulo, $titulo, $latitud, $longitud, $fecha_cierre, $copete, $url_contenido, $contenido_adicional, $id_numero)
    {
        $articuloModel = new ArticuloModel ();
        $articuloModel->id = $id;
        $articuloModel->id_seccion = $id_seccion;
        $articuloModel->id_usuario = $id_usuario;
        $articuloModel->id_estado_articulo = $id_estado_articulo;
        $articuloModel->titulo = $titulo;
        $articuloModel->latitud = $latitud;
        $articuloModel->longitud = $longitud;
        $articuloModel->fecha_cierre = $fecha_cierre;
        $articuloModel->copete = $copete;
        $articuloModel->url_contenido = $url_contenido;
        $articuloModel->contenido_adicional = $contenido_adicional;
        $articuloModel->id_numero = $id_numero;
        $message = $this->validateArticulo($articuloModel);

        // Si esta vacio, no hay mensaje de error por lo tanto es válido
        if (empty ($message)) {

            $result = $this->updateArticulo($articuloModel);
        } else {
            // En caso de ser invalido devuelve un mensaje de validacion
            $result = $message;
        }

        return $result;
    }

    /**
     * Actualiza un articulo a partir de un objeto ArticuloModel, si tuvo exito devuelve verdadero
     * caso contrario devuelve falso
     */
    private function updateArticulo($articuloModel)
    {

        $titulo = !$this->validationHelper->validateNull($articuloModel->titulo) ? $articuloModel->titulo : null;

        $sql = " UPDATE articulo
					SET
					id_seccion = $articuloModel->id_seccion,
					id_usuario = $articuloModel->id_usuario,
					id_estado_articulo = $articuloModel->id_estado_articulo";

        /* para que no viaje basura a la bd pregunto si el campo no esta nulo, entonces lo considero para el update */

        if (!$this->validationHelper->validateNull($articuloModel->titulo)) {

            $sql .= ",titulo = '$articuloModel->titulo'";
        }

        if (!$this->validationHelper->validateNull($articuloModel->latitud)) {

            $sql .= ",latitud = '$articuloModel->latitud'";
        }

        if (!$this->validationHelper->validateNull($articuloModel->longitud)) {

            $sql .= ",longitud = '$articuloModel->longitud'";
        }

        if (!$this->validationHelper->validateNull($articuloModel->fecha_cierre)) {

            $sql .= ",fecha_cierre = '$articuloModel->'fecha_cierre'";
        }

        if (!$this->validationHelper->validateNull($articuloModel->longitud)) {

            $sql .= ",fecha_cierre = '$articuloModel->'fecha_cierre'";
        }

        if (!$this->validationHelper->validateNull($articuloModel->copete)) {

            $sql .= ",copete = '$articuloModel->copete'";
        }

        if (!$this->validationHelper->validateNull($articuloModel->url_contenido)) {

            $sql .= ",url_contenido = '$articuloModel->url_contenido'";
        }

        if (!$this->validationHelper->validateNull($articuloModel->contenido_adicional)) {

            $sql .= ",contenido_adicional = '$articuloModel->contenido_adicional'";
        }

        $sql .= " WHERE id = $articuloModel->id;";

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
}

?>

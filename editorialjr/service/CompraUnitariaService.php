<?php

require_once(__DIR__ . "/../common/DataAccess.php");
require_once(__DIR__ . "/../model/CompraUnitariaModel.php");
require_once(__DIR__ . "/../service/PublicacionService.php");
require_once(__DIR__ . "/../helpers/LoggerHelper.php");

class CompraUnitariaService
{

    private $dataAccess = null;

    public function __construct()
    {
        $this->dataAccess = new DataAccess;
    }
    public function getAllComprasUnitariasPorPeriodo($dateStart,$dateEnd){

        $sql = "SELECT c.id_publicacion, p.nombre, count(*) cantidad
                from compra_unitaria c
                inner join publicacion p on c.id_publicacion = p.id
                where c.fecha BETWEEN '$dateStart' AND '$dateEnd'
                group by c.id_publicacion;";

        try {
            $compras = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($sql);
            return null;
        }
        return $compras;
    }

    public function getAllSuscripcionesPorPeriodo($dateStart,$dateEnd){

        $sql = "SELECT c.fecha, count(*) cantidad
                from suscripcion c
                where c.fecha BETWEEN '$dateStart' AND '$dateEnd'
                group by c.fecha;";

        try {
            $compras = $this->dataAccess->getMultipleResults($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($sql);
            return null;
        }
        return $compras;
    }

    public function comprarUltimoNumero($idCliente, $idPublicacion)
    {

        $publicacionService = new PublicacionService();
        $lastID = $publicacionService->getIdLastNumero($idPublicacion);

        $compraUnitariaModel = new CompraUnitariaModel();
        $compraUnitariaModel->id_cliente = $idCliente;
        $compraUnitariaModel->id_numero = $lastID;
        $compraUnitariaModel->id_publicacion = $idPublicacion;
        return $this->insertCompraUnitaria($compraUnitariaModel);
    }

    /**
     * Obtiene un CompraUnitariaModel por su id
     */
    public function getComprasUnitariasByIdCliente($idCliente)
    {
        /*$sql = "SELECT id_cliente, id_numero, fecha, p.nombre nombrePublicacion
                from compra_unitaria cu
                left join numero n on cu.id_numero = n.id
                left join publicacion p on n.id_publicacion = p.id
                WHERE id_cliente = $idCliente;";
*/
        $sql = "SELECT id_cliente, id_numero, fecha, id_publicacion
					FROM editorialjr.compra_unitaria
					WHERE id_cliente = $idCliente;";

        try {

            $comprasUnitariasDBArray = $this->dataAccess->getMultipleResults($sql);

        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);

            return null;
        }

        $arrayComprasUnitariasModel = array();

        foreach ($comprasUnitariasDBArray as $compraUnitariaDB) {
            $compraUnitariaModel = $this->convertCompraUnitariaDBToCompraUnitariaModel($compraUnitariaDB);
            $arrayComprasUnitariasModel [] = $compraUnitariaModel;
        }

        return $arrayComprasUnitariasModel;
    }

    /**
     * Convierte una compra unitaria de la base de datos en un objeto CompraUnitariaModel y lo devuelve
     * */
    private function convertCompraUnitariaDBToCompraUnitariaModel($compraUnitariaDB)
    {

        /* Convierto el resultado de la BD a un objeto modelado */
        $compraUnitariaModel = new CompraUnitariaModel;
        $compraUnitariaModel->id_cliente = $compraUnitariaDB["id_cliente"];
        $compraUnitariaModel->id_numero = $compraUnitariaDB["id_numero"];
        $compraUnitariaModel->fecha = $compraUnitariaDB["fecha"];
        $compraUnitariaModel->id_publicacion = $compraUnitariaDB["id_publicacion"];
        return $compraUnitariaModel;
    }

    public function createCompraUnitaria($compraUnitariaModel)
    {
        $result = $this->insertCompraUnitaria($compraUnitariaModel);
        return $result;
    }

    private function insertCompraUnitaria($compraUnitariaModel)
    {
        //ver comentarios en articuloService para el mismo tipo de metodo.
        $sql = " INSERT
		INTO compra_unitaria
		(
		id_cliente,
		id_numero,
		fecha,
		id_publicacion
		)
		VALUES
		($compraUnitariaModel->id_cliente,
		$compraUnitariaModel->id_numero,
		DATE(NOW()),
		$compraUnitariaModel->id_publicacion
		);";

        try {
            $this->dataAccess->execute($sql);
        } catch (Exception $e) {
            $logger = Logger::getRootLogger();
            $logger->error($e);
            return false;
        }
        return $sql;
    }

}

?>

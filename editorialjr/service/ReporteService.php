<?php
require_once(__DIR__ . "/../helpers/LoggerHelper.php");
require_once(__DIR__ . "/../service/ClienteService.php");
require_once(__DIR__ . "/../service/SuscripcionService.php");
require_once(__DIR__ . "/../service/PublicacionService.php");
require_once(__DIR__ . "/../service/NumeroService.php");
require_once(__DIR__ . "/../service/CompraUnitariaService.php");

class ReporteService
{

    public function generarReporteClientes()
    {
        $html = "<!DOCTYPE html><html lang='en'><head><meta charset='utf-8'>
                  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                  <meta name='viewport' content='width=device-width, initial-scale=1'>
                  <meta name='description' content=''>
                  <meta name='author' content=''><link href='../css/bootstrap.css' rel='stylesheet'>
                    </head>
                      <body>
                        <div class='container'>
                          <h3>Editorial Jr - Reporte: Clientes y productos adquiridos</h3>
                          <table class='table table-striped table-bordered'>
                            <thead>
                              <tr style='background-color: #F3F781;'>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Calle</th>
                                <th>Número</th>
                                <th>Dpto</th>
                                <th>Estado</th>
                                <th>Ciudad</th>
                              </tr>
                            </thead>
                            <tbody>";

        $clienteService = new ClienteService;
        $suscripcionService = new SuscripcionService;
        $compraUnitariaService = new CompraUnitariaService;

        $listaClientes = $clienteService->getAllClientes();

        foreach ($listaClientes as $cliente) {
            // Primer fila
            $html .= "<tr style='background-color: #F2F5A9;'>
                  <td>$cliente->email</td>
                  <td>$cliente->nombre</td>
                  <td>$cliente->apellido</td>
                  <td>$cliente->calle</td>
                  <td>$cliente->numero_calle</td>
                  <td>$cliente->departamento</td>
                  <td>$cliente->descripcion_estado_cliente</td>
                  <td>$cliente->descripcion_ciudad</td>
                </tr>";

            $listaSuscripciones = $suscripcionService->getSuscripcionesByIdCliente($cliente->id);

            if ($listaSuscripciones != null) {
                foreach ($listaSuscripciones as $suscripcion) {
                    // Segunda fila - Opcion A
                    $html .= "<tr>
                      <td colspan='8'>
                        <strong>Publicaciones del cliente: $cliente->email</strong>
                        <table class='table table-striped table-bordered'>
                          <thead>
                            <tr style='background-color: #F5F6CE;'>
                              <th>Publicación</td>
                              <th>Precio</td>
                              <th>Fecha</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>$suscripcion->nombrePublicacion</td>
                              <td>$suscripcion->precio</td>
                              <td>$suscripcion->fecha</td>
                            <tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>";
                }
            } else {
                $html .= "<tr>
                    <td colspan='8'><strong>El cliente no posee suscripciones.</strong></td>
                  </tr>";
            }

            $listaComprasUnitarias = $compraUnitariaService->getComprasUnitariasByIdCliente($cliente->id);

            if ($listaComprasUnitarias != null) {
                foreach ($listaComprasUnitarias as $compraUnitaria) {
                    // Segunda fila - Opcion A
                    $precio = $compraUnitaria->getNumero()->precio;

                    $html .= "<tr>
                      <td colspan='8'>
                        <strong>Compras unitarias del cliente: $cliente->email</strong>
                        <table class='table table-striped table-bordered'>
                          <thead>
                            <tr style='background-color: #F5F6CE;'>
                              <th>Publicación</td>
                              <th>Precio</td>
                              <th>Fecha</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>$compraUnitaria->nombrePublicacion</td>
                              <td>$precio</td>
                              <td>$compraUnitaria->fecha</td>
                            <tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>";
                }
            } else {
                $html .= "<tr>
                    <td colspan='8'><strong>El cliente no posee compras unitarias.</strong></td>
                  </tr>";
            }

        }// Fin foreach clientes


        // Fin de la tabla padre
        $html .= "</tbody>
            </table>
          </div>
        </body>
      </html>";

        return $html;

    }//Fin del metodo generarReporteClientes

    public function generarReporteProductos()
    {
        $html = "<!DOCTYPE html><html lang='en'><head><meta charset='utf-8'>
                  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                  <meta name='viewport' content='width=device-width, initial-scale=1'>
                  <meta name='description' content=''>
                  <meta name='author' content=''><link href='../css/bootstrap.css' rel='stylesheet'>
                    </head>
                      <body>
                        <div class='container'>
                          <h3>Editorial Jr - Reporte: Productos, suscripciones por producto y compras unitarias</h3>
                          <table class='table table-striped table-bordered'>
                            <thead>
                              <tr style='background-color: #F3F781;'>
                                <th>Producto / Publicación</th>
                                <th>Cantidad de suscripciones</th>
                              </tr>
                            </thead>
                            <tbody>";

        $publicacionService = new PublicacionService;
        $numeroService = new NumeroService;
        $listaPublicaciones = $publicacionService->getCantidadSuscipcionesPorPublicacion();

        foreach ($listaPublicaciones as $publicacion) {
          $html .= "<tr style='background-color: #F2F5A9;'>
                      <td>" . $publicacion["nombre"] . "</td>
                      <td>" . $publicacion["cantidadSuscripciones"] . "</td>
                    </tr>";
          $html .= " <tr>
                      <td colspan='2'>
                        <strong>Detalle números de la publicación '" . $publicacion["nombre"] . "' y sus compras unitarias.</strong>
                        <table class='table table-striped table-bordered'>
                          <thead>
                            <tr style='background-color: #F5F6CE;'>
                              <th>Número de revista</td>
                              <th>Estado</td>
                              <th>Precio</td>
                              <th>Fecha publicado</td>
                              <th>Cantidad de compras</td>
                            </tr>
                          </thead>
                          <tbody>";

          $listaNumeros = $numeroService->getComprasUnitariasDeNumerosPorIdPublicacion($publicacion["id"]);

          foreach ($listaNumeros as $numero) {

              $html .= " <tr>
                            <td>" . $numero["numero_revista"] . "</td>
                            <td>" . $numero["estado"] . "</td>
                            <td>" . $numero["precio"] . "</td>
                            <td>" . $numero["fecha_publicado"] . "</td>
                            <td>" . $numero["cantidadCompras"] . "</td>
                          </tr>";
            }

            $html .= "  </tbody>
                      </table>
                    </td>
                  </tr>";
        }// Fin foreach publicaciones

        $html .= "</tbody>
            </table>
          </div>
        </body>
      </html>";

        return $html;
    }

}// Fin de la clase

?>

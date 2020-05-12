<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    
include_once 'ventas.php';
include_once '../products/apiproductos.php';

class ApiVentas{
    
    // Aqui tienes todas las funciones
    function addVenta($idDate, $priceTotal)
    {
        $venta = new venta();

        $venta->nuevaVenta($idDate, $priceTotal);
        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
        return 0;
    }
    function addDetalles($detalles, $id)
    {
        $venta = new venta();

        $venta->nuevoDetalles($detalles, $id);
        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
        return 0;
    }
    function profits() 
    {
        // Llama a los productos y los guarda
        $llamadaProductos = new ApiProducto();
        $productos = $llamadaProductos->getAll();
        //$productos = json_decode($llamadaProductos2, true);
        // Inicializa la "Venta" para calcular las ganancias
        $total["items"] = array();
        $venta = new venta();
        // Calcula la fecha de hoy menos 24H
        $fecha = new DateTime();
        $fecha->getTimestamp();
        $datenow = $fecha - 86400;
        // Obtiene las ventas CREO QUE NO SE NECESITA
        //$gVenta = $venta->gananciasVenta($datenow);

        // Obtiene los productos comprados
        $gDetalles = $venta->gananciasDetalles($datenow);
        /* NO NECESARIO POR AHORA
        if($gVenta->rowCount() !== 0) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            //$row = $gVenta->fetch();

            while ($row = $gVenta->fetch(PDO::FETCH_ASSOC)){
                $item=array
                (
                    "_id" => $row['id_venta'],
                    "total" => $row['total']
                );
                array_push($total["items"], $item);
            }
            echo json_encode($total);
        }
        else
        {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
        */
        if($gDetalles->rowCount() !== 0) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            //$row = $gDetalles->fetch();

            while ($row = $gDetalles->fetch(PDO::FETCH_ASSOC)){
                $item=array
                (
                    "id_sale" => $row['codigoventa'],
                    "id_product" => $row['codigoproducto'],
                    "cant" => $row['cantidad']

                );
                array_push($total["items"], $item);
            }
            foreach ($productos["items"] as $clave => $detalles) {
                echo $detalles["_id"];
            }
            //echo json_encode($total);
        }
        else
        {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
        return 0;
    }
}

// Aqui mandamos a llamar toda la API 
// Esto es lo más importante
$api = new ApiVentas();

$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['idDate'])){
    $id = $data['idDate'];
    if($data['method'] == "POST") {
        $api->addVenta($data['idDate'], $data['priceTotal']);
        foreach ($data['products'] as $clave => $detalles) {
            $api->addDetalles($detalles, $id);
        }
    } 
}else{
    //Aquí mandaremos llamar la función para calcular las ganancias
    $api->profits();
}
?>
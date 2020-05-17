<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    
require 'ventas.php';
require '../products/classes.php';

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

        $llamadaProductos = new ApiProducto(); // Llama a todos los productos
        $productos = $llamadaProductos->getById($detalles['_id']);
        foreach ($productos["items"] as $clave => $producto) {
            if ($detalles["_id"] == $producto["_id"]) {
                $nuevoStock = $producto['total'] - $detalles['cant'];
                $llamadaProductos->updateStock($producto["_id"], $nuevoStock);
            }
        }

        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
        return 0;
    }
    function profits() 
    {
        // Variable de ganancias, 1 Operaciones 
        $ganancias = 0;
        // Llama a los productos y los guarda
        $llamadaProductos = new ApiProducto();
        $productos = $llamadaProductos->getAll();
        //$productos = json_decode($llamadaProductos2, true);
        // Inicializa la "Venta" para calcular las ganancias
        $total["items"] = array();
        $venta = new venta();
        // Calcula la fecha de hoy menos 24H
        $fecha = new DateTime();
        $timestamp = $fecha->getTimestamp();
        //echo $timestamp;
        $datenow = $timestamp - 86400;

        // Obtiene los productos comprados
        $gDetalles = $venta->gananciasDetalles($datenow);

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
                foreach ($productos["items"] as $clave => $detalles) {
                    if ($row['codigoproducto'] == $detalles["_id"]) {
                        $cantidadVendida = $row['cantidad'] * $detalles['price'];
                        $cantidadComprada = $row['cantidad'] * $detalles['buy'];
                        $operacion = $cantidadVendida - $cantidadComprada;
                        $ganancias = $ganancias + $operacion;
                    }
                }
            }
            $profits = array("profits" => $ganancias);
            //array_push($profits["profits"], $ganancias);
            //echo $profits["profits"];
            echo json_encode($profits);
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
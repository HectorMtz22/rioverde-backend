<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    
include_once 'ventas.php';

class ApiVentas{
    
    // Aqui tienes todas las funciones
    function addVenta($idDate, $priceTotal)
    {
        $venta = new venta();

        $venta->nuevaVenta($idDate, $priceTotal);
        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
        return 0;
    }
    function addDetalles($item)
    {
        $venta = new venta();

        $venta->nuevoDetalles($item);
        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
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
        //$api->addVenta($data['idDate'], $data['priceTotal']);

        $dataDetalles = json_decode($data['products'], true);
        $api->addDetalles($dataDetalles);

        echo $dataDetalles['idDate'];
        echo $dataDetalles['_id'];
        echo $dataDetalles['cant'];
        /*
        foreach ($data['products'] as $clave => $valor) {
            print "$clave => $valor";
            //
        }
        */
    } 
}else{
    //Aquí mandaremos llamar la función para calcular las ganancias
}
?>
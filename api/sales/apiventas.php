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
    function addDetalles($detalles, $id)
    {
        $venta = new venta();

        $venta->nuevoDetalles($detalles, $id);
        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
        return 0;
    }
    function profits() 
    {
        $total["items"] = array();
        $venta = new venta();

        $fecha = new DateTime();
        $fecha->getTimestamp();
        $datenow = $fecha - 86400;

        $resultado = $venta->ganancias($datenow);

        if($resultado->rowCount() !== 0) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            //$row = $resultado->fetch();

            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                $item=array
                (
                    "profits" => $row['codigoventa']
                );
                array_push($total["items"], $item);
            }
            echo json_encode($total);
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
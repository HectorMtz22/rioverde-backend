<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    
require 'salida.php';

class ApiSalidas{
    
    // Aqui tienes todas las funciones
    function output($dateStart, $dateEnd) 
    {
        $total["items"] = array();
        $salida = new Salida();

        $resultado = $salida->obtenerDetallesSalida($dateStart, $dateEnd);

        if($resultado->rowCount() !== 0) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            //$row = $resultado->fetch();

            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                $item=array
                (
                    "idDate" => $row['codigoventa'],
                    "idProduct" => $row['codigoproducto'],
                    "cant" => $row['cantidad']
                );
                array_push($total["items"], $item);
            }
            
        }
        else
        {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
        return $total;
    }
}

// Aqui mandamos a llamar toda la API 
// Esto es lo más importante
$api = new ApiSalidas();

$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['dateStart'])){
    $salidas = $api->output($date['dateStart'], $date['dateEnd']);
    echo json_encode($salidas);
}
?>
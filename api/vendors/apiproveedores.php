<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    
include_once 'proveedor.php';

class ApiProveedor{


    function getAll()
    {
        $total["items"] = array();
        $proveedor = new Proveedor();

        $resultado = $proveedor->obtenerProveedor();

        if($resultado->rowCount()) //la variable "$row" es = a fila, rowcount es contar las filas
        {

            
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC))
            {
    
                $item=array
                (
                    "_id" => $row['codigo'],
                    "name" => $row['nombre'],
                    "brand" => $row['marca'],
                    "price" => $row['precio'],
                    "total" => $row['stock']
                );
                array_push($total["items"], $item);
            }
            echo json_encode($total);
        }
        else
        {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }
}

    $api = new ApiProveedor();

    $api->getAll();
?>
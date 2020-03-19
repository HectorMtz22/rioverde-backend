<?php

include_once 'producto.php';

class ApiProducto{


    function getAll()
    {
        $total["items"] = array();
        $producto = new Producto();

        $resultado = $producto->obtenerProducto();

        if($resultado->rowCount()) //la variable "$row" es = a fila, rowcount es contar las filas
        {

            
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC))
            {
    
                $item=array
                (
                    "_id" => $row['Codigo'],
                    "name" => $row['Nombre'],
                    "brand" => $row['Marca'],
                    "price" => $row['Precio'],
                    "total" => $row['Stock']
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

?>
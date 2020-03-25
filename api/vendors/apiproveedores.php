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

        $resultado = $proveedor->obtenerProveedores();

        if($resultado->rowCount() !== 0) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC))
            {
    
                $item=array
                (
                    "_id" => $row['id_proveedores'],
                    "name" => $row['nombre'],
                    "frecuencies" => $row['frecuencias']
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
    function getById($id)
    {
        $total["items"] = array();
        $proveedor = new Proveedor();

        $resultado = $proveedor->obtenerProveedor($id);

        if($resultado->rowCount()) //la variable "$row" es = a fila, rowcount es contar las filas
        {

            while ($row = $resultado->fetch(PDO::FETCH_ASSOC))
            {
    
                $item=array
                (
                    "_id" => $row['id_proveedores'],
                    "name" => $row['nombre'],
                    "frecuencies" => $row['frecuencias']
                );
                //array_push($total["items"], $item); NO UTILIZAR
            }
            echo json_encode($item);
        }
        else
        {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
        return 0;
    }

    // Aqui tienes todas las funciones
    function add($item)
    {
        $proveedor = new Proveedor();

        $resultado = $proveedor->nuevoProveedor($item);
        //$this->json_encode(array('mensaje' => '¡Nuevo Producto Registrado!'));
        return 0;
    }
    function update($item)
    {
        $proveedor = new Proveedor();

        $resultado = $proveedor->actualizarProveedor($item);
        //$this->json_encode(array('mensaje' => '¡Producto Actualizado!'));
        return 0;
    }
    function delete($id)
    {
        $proveedor = new Proveedor();

        $resultado = $proveedor->eliminarProveedor($id);
        //$this->json_encode(array('mensaje' => '¡Producto Eliminado!'));
        return 0;
    }
}

$api = new ApiProveedor();

$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['_id'])){
    $id = $data['_id'];
    if($data['method'] == "GET") {
        if(is_numeric($id)){
            $api->getById($id);
        }else{
            $api->json_encode(array('mensaje' => '¡Los parámetros son incorrectos!'));
        }
    }
    if($data['method'] == "POST") {
        $api->add($data);
    } 
    if($data['method'] == "PUT") {
        $api->update($data);
    }
    if($data['method'] == "DELETE") {
        $api->delete($id);
    }
}else{
    $api->getAll();
}
?>
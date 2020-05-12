<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    
include_once 'classes.php';

// Aqui mandamos a llamar toda la API 
// Esto es lo más importante
$api = new ApiProducto();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['_id'])){
    $id = $data['_id'];
    if($data['method'] == "GET") {
        if(is_numeric($id)){
            $api->getById($id);
        }else{
            json_encode(array('mensaje' => '¡Los parámetros son incorrectos!'));
        }
    }
    if($data['method'] == "POST") {
        $api->add($data);
    } 
    if($data['method'] == "PUT") {
        if($data['stock'] == "ASIES") {
            foreach ($data['_id'] as $clave => $valor) {
                $api->updateStock($clave, $valor);
            }
        } else {
            $api->update($data);
        }
    }
    if($data['method'] == "DELETE") {
        $api->delete($id);
    }
}else{
    $todosProductos = $api->getAll();
    echo json_encode($todosProductos);
}
?>
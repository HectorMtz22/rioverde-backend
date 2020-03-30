<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include_once 'user.php';

class ApiUser {
    function verificar($user)
    {
        $total["items"] = array();
        $usur = new Usuario();

        $resultado = $usur->verificarUsuario($user);
        
        if($resultado->rowCount()) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $item=array
                (
                    "usernumber" => $row['codigo_usuario'],
                    "email" => $row['email'],
                    "name" => $row['nombre'],
                    "tel" => $row['telefono']
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
    function nohay() {
        echo json_encode(array('mensaje' => 'No hay elementos'));
    return 0;
    }
}
$api = new ApiUser();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['usernumber']) AND isset($data['pass'])){
    $api->verificar($data);
}else{
    $api->nohay();
}
?>
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include_once 'user.php';

class ApiUser {
    function verify($user)
    {
        $usuario = new Usuario();

        $resultado = $usuario->verificarUsuario($user);
        
        if($resultado->rowCount()) //la variable "$row" es = a fila, rowcount es contar las filas
        {
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $item=array
                (
                    "auth" => true,
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
            $item=array
            (
                "auth" => false,
                "mensaje" => "No hay elementos"
            );
            echo json_encode($item);
        }
        return 0;
    }
}
$api = new ApiUser();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['usernumber'] && isset($data['pass']))){
    $api->verify($data);
}else{
    $item=array
    (
        "auth" => false
    );
    echo json_encode($item);
    return 0;
}
?>
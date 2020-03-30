<?php

include_once '../db.php';

class Usuario extends DB{
    function verificarUsuario($usuario)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE codigo_usuario = :usernumber AND contraseña = :pass');
        $query->execute([
            ':usernumber' => $usuario['usernumber'], 
            ':pass' => $usuario['pass']
        ]);
        return $query;
    }
}
?>
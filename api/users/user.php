<?php

include_once '../db.php';

class Usuario extends DB{
    function verificarUsuario($usuario)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE codigo_usuario = :codigo AND contraseña = :contra');
        $query->execute([
            ':codigo' => $usuario['usernumber'], 
            ':contra' => $usuario['pass']
        ]);
        return $query;
    }
}
?>
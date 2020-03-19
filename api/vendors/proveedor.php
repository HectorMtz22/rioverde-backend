<?php

include_once '../db.php';

class Proveedor extends DB{
    
    function obtenerProveedor(){
        $query = $this->connect()->query("SELECT * FROM provedores");
        return $query;
    }

}

?>
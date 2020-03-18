<?php

include_once 'db.php';

class Producto extends DB{
    
    function obtenerProducto(){
        $query = $this->connect()->query("SELECT * FROM productos");
        return $query;
    }

}

?>
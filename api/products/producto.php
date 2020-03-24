<?php

include_once '../db.php';

class Producto extends DB{
    
    function obtenerProductos(){
        $query = $this->connect()->query('SELECT * FROM productos');
        return $query;
    }

    // (A) esto es para filtrar los datos, si te causa error lo puedes borrar @hector
    function obtenerProducto($id)
    {
        $query = $this->connect()->prepare('SELECT * FROM productos WHERE codigo = :id');
        $query->execute([':id' => $id]);

        return $query;
    }
 
    function nuevoProducto($producto)
    {
        $query = $this->connect()->prepare('INSERT INTO productos (codigo, nombre, marca, precio, stock) VALUES (/*aqui van las variables, solo que no se si son estas o si sean las que dicen name, brand, price, etc. asi que las puedes cambiar despues*/:codigo, :nombre, :marca, :precio, :stock)');
        $query->execute([
            ':codigo' => $producto['_id'], 
            ':nombre' => $producto['name'], 
            ':marca' => $producto['brand'], 
            ':precio' => $producto['price'], 
            ':stock' => $producto['total']
        ]);

        return $query;  
    }

}

?>
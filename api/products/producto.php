<?php

include_once '../db.php';

class Producto extends DB{
    function obtenerProductos(){
        $query = $this->connect()->query('SELECT * FROM productos');
        return $query;
    }
    function obtenerProducto($id)
    {
        $query = $this->connect()->prepare('SELECT * FROM productos WHERE codigo = :id');
        $query->execute([':id' => $id]);
        return $query;
    }
    function nuevoProducto($producto)
    {
        $query = $this->connect()->prepare('INSERT INTO productos (codigo, nombre, marca, compra, precio, stock) VALUES (/*aqui van las variables, solo que no se si son estas o si sean las que dicen name, brand, price, etc. asi que las puedes cambiar despues*/:codigo, :nombre, :marca, :compra, :precio, :stock)');
        $query->execute([
            ':codigo' => $producto['_id'], 
            ':nombre' => $producto['name'], 
            ':marca' => $producto['brand'], 
            ':compra' => $producto['buy'], 
            ':precio' => $producto['price'], 
            ':stock' => $producto['total']
        ]);
        return $query;  
    }
    function actualizarProducto($producto)
    {
        $query = $this->connect()->prepare('UPDATE productos SET nombre = :nombre, marca = :marca, compra = :compra, precio = :precio, stock = :stock WHERE codigo = :codigo');
        $query->execute([
            ':codigo' => $producto['_id'], 
            ':nombre' => $producto['name'], 
            ':marca' => $producto['brand'], 
            ':compra' => $producto['buy'], 
            ':precio' => $producto['price'], 
            ':stock' => $producto['total']
        ]);
        return $query;  
    }
    function actualizarStock($codigo, $stock)
    {
        $query = $this->connect()->prepare('UPDATE productos SET stock = :stock WHERE codigo = :codigo');
        $query->execute([
            ':codigo' => $codigo,
            ':stock' => $stock
        ]);
        return $query;  
    }
    function eliminarProducto($id) 
    {
        $query = $this->connect()->prepare('DELETE FROM productos WHERE codigo = :id');
        $query->execute([':id' => $id]);
        return $query;
    }

}
?>
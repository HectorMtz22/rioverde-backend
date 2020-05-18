<?php

include_once '../db.php';

class Proveedor extends DB{
    
    function obtenerProveedores(){
        $query = $this->connect()->query("SELECT * FROM proveedores ORDER BY nombre ASC");
        return $query;
    }
    function obtenerProveedor($id)
    {
        $query = $this->connect()->prepare('SELECT * FROM proveedores WHERE id_proveedores = :id');
        $query->execute([':id' => $id]);
        return $query;
    }
    function nuevoProveedor($proveedor)
    {
        $query = $this->connect()->prepare('INSERT INTO proveedores (id_proveedores, nombre, frecuencias) VALUES (:id, :nombre, :frecuencias)');
        $query->execute([
            ':id' => $proveedor['_id'], 
            ':nombre' => $proveedor['name'], 
            ':frecuencias' => $proveedor['frecuencies']
        ]);
        return $query;  
    }
    function actualizarProveedor($proveedor)
    {
        $query = $this->connect()->prepare('UPDATE proveedores SET nombre = :nombre, frecuencias = :frecuencias WHERE id_proveedores = :id');
        $query->execute([
            ':id' => $proveedor['_id'], 
            ':nombre' => $proveedor['name'], 
            ':frecuencias' => $proveedor['frecuencies']
        ]);
        return $query;  
    }
    function eliminarProveedor($id) 
    {
        $query = $this->connect()->prepare('DELETE FROM proveedores WHERE id_proveedores = :id');
        $query->execute([':id' => $id]);
        return $query;
    }
}

?>
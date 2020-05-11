<?php

include_once '../db.php';

class Venta extends DB{
    
    function nuevaVenta($idDate, $priceTotal)
    {
        $query = $this->connect()->prepare('INSERT INTO venta (id_venta, total) VALUES (:idDate, :priceTotal)');
        $query->execute([
            ':idDate' => $idDate, 
            ':priceTotal' => $priceTotal
        ]);
        return $query;  
    }
    function nuevoDetalles($detallesVenta)
    {
        $query = $this->connect()->prepare('INSERT INTO venta (id_venta, total) VALUES (:idDate, :priceTotal)');
        $query->execute([
            ':idDate' => $detallesVenta, 
            ':priceTotal' => $detallesVenta,
            ':idDate' => $detallesVenta, 
            ':priceTotal' => $detallesVenta
        ]);
        return $query;  
    }

}
?>
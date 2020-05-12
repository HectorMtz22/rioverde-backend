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
    function nuevoDetalles($detalles, $id)
    {
        $query = $this->connect()->prepare('INSERT INTO detallesventa (codigoventa, codigoproducto, cantidad) VALUES (:codigoventa, :codigoproducto, :cantidad)');
        $query->execute([
            ':codigoventa' => $id, 
            ':codigoproducto' => $detalles['_id'],
            ':cantidad' => $detalles['cant']
        ]);
        return $query;  
    }
    function ganancias()
    {
        $fecha = new DateTime();
        $fecha->getTimestamp();
        $datenow = $fecha - 86400;
        //$query = $this->connect()->query('SELECT * FROM productos ORDER BY nombre ASC');
        $query1 = $this->connect()->prepare('SELECT * FROM detallesventa WHERE codigoventa > :datenow');
        $query1->execute([
            ':datenow' => $datenow
        ]);
        return $query1;
        
    }

}
?>
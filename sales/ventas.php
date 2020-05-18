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
    function gananciasVenta($dateStart, $dateEnd)
    {
        //$query = $this->connect()->query('SELECT * FROM productos ORDER BY nombre ASC');
        $query = $this->connect()->prepare('SELECT * FROM venta WHERE (id_venta
        >= :dateStart AND id_venta <= :dateEnd)');
        $query->execute([
            ':dateStart' => $dateStart,
            ':dateEnd' => $dateEnd
        ]);
        return $query;
        
    }
    function gananciasDetalles($dateStart, $dateEnd)
    {
        //$query = $this->connect()->query('SELECT * FROM productos ORDER BY nombre ASC');
        $query = $this->connect()->prepare('SELECT * FROM detallesventa WHERE (codigoventa >= :dateStart AND codigoventa <= :dateEnd)');
        $query->execute([
            ':dateStart' => $dateStart,
            ':dateEnd' => $dateEnd
        ]);
        return $query;
        
    }

}
?>
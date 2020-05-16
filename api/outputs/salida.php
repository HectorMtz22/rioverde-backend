<?php

include_once '../db.php';

class Salida extends DB{
    function obtenerDetallesSalida($dateStart, $dateEnd)
    {
        $query = $this->connect()->prepare('SELECT * FROM detallesventa WHERE codigoventa >= :dateStart AND codigoventa <= :dateEnd');
        $query->execute([
            ':dateStart' => $dateStart,
            ':dateEnd' => $dateEnd
        ]);
        return $query;
    }
}
?>
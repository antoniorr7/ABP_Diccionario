<?php
require_once 'models/conexion.php';

class Palabra extends Conexion {
    public function __construct() { 
        parent::__construct();
    }
    public function listarPalabras($idClase){

        $query = "SELECT p.idPalabra, p.palabra, t.idTraduccion, t.significados
                FROM palabras p
                LEFT JOIN traducciones t ON p.idPalabra = t.idPalabra
                where idClase= $idClase";
        
        $resultado = $this->conexion->query($query); 

        
      
        while ($row = $resultado->fetch_assoc()) {
            $palabras[] = $row;
        }
        
        return $palabras;
    }
    
}
?>
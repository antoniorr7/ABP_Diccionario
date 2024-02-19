<?php
require_once 'models/conexion.php';

class Traduccion extends Conexion {
    public function __construct() { 
        parent::__construct();
    }

    public function listar($idPalabra) {
        echo $idPalabra;
        $this->palabraTraduccion($idPalabra);
        $query = "SELECT * FROM traducciones WHERE idPalabra = '$idPalabra'";

        $resultado = $this->conexion->query($query); 

        if ($resultado === false) {
            return 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                return null;
            } else {
                foreach ($resultado as $fila) {
                    $traducciones[] = $fila;
                }
            }
            return $traducciones;
        }
    }
    public function palabraTraduccion($idPalabra) {
        $query = "SELECT * FROM palabras 
        where idPalabra=$idPalabra";

        $resultado = $this->conexion->query($query);

        if ($resultado === false) {
            return 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                return null;
            } else {
                foreach ($resultado as $fila) {
                    $palabras[] = $fila;
                }
            }
           
            return $palabras;
        }
    }
    public function aniadir($idPalabra, $significados) {
        $query = "INSERT INTO traducciones (idPalabra, significados) VALUES ('$idPalabra', '$significados')";

        $resultado = $this->conexion->query($query);

        if ($resultado === false) {
            return 'Error al insertar en la base de datos';
        } else {
            return 'Traducción insertada correctamente';
        }
    }

    public function borrar($idTraduccion) {
        $query = "DELETE FROM traducciones WHERE idTraduccion = '$idTraduccion'";

        $resultado = $this->conexion->query($query);

        if ($resultado === false) {
            return 'Error al eliminar de la base de datos';
        } else {
            return 'Traducción eliminada correctamente';
        }
    }
    
}
?>
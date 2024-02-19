<?php
require_once 'models/conexion.php';

class Palabra extends Conexion {
    public function __construct() { 
        parent::__construct();
    }

    public function listar($idClase) {
        $query = "SELECT p.idPalabra, p.audio, p.palabra, c.nombreClase 
        FROM palabras p 
        JOIN clase c ON p.idClase = c.id 
        WHERE p.idClase = $idClase";

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

    public function aniadir($idClase, $palabra,$audio) {
        $query = "INSERT INTO palabras (idClase, palabra, audio) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            return 'Error al preparar la consulta';
        }
    
        // Vincular parámetros
        $stmt->bind_param("iss", $idClase, $palabra,$audio);
    
        // Ejecutar la consulta preparada
        $resultado = $stmt->execute();
    
        if ($resultado === false) {
            return 'Error al insertar en la base de datos';
        } else {
            return 'Palabra añadida';
        }
    }
    public function borrar($idPalabra) {
        $query = "DELETE FROM palabras 
        WHERE idPalabra = $idPalabra 
        RETURNING idClase; ";
        
        $resultado = $this->conexion->query($query);
        
        if ($resultado === false) {
            return 'Error al eliminar la palabra';
        } else {
            return 'Palabra eliminada';
        }
    }
    public function editar($idPalabra,$palabra) {

        $query = "UPDATE palabras SET palabra = ? WHERE idPalabra = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("si", $palabra, $idPalabra);
        if ($stmt->execute()) {
            return 'Palabra editada';
        } else {
            return 'Error al editar la palabra';
        }
    }

public function cogerDatosPalabra($idPalabra) {
    $query = "SELECT *, idClase FROM palabras WHERE idPalabra = $idPalabra";

    $resultado = $this->conexion->query($query);
    if ($resultado === false) {
        return 'Error al consultar la base de datos';
    } else {
        if ($resultado->num_rows === 0) {
            return null;
        } else {
            // Aquí obtenemos el resultado de la consulta y lo devolvemos
            $fila = $resultado->fetch_assoc();
            return $fila;
        }
    }
}

    
}

?>
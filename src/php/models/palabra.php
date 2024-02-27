<?php
require_once 'models/conexion.php';

class Palabra extends Conexion {
    public function __construct() { 
        parent::__construct();
    }
    public function listarPalabras($idClase){
        $query = "SELECT p.idPalabra, p.palabra, t.idTraduccion, t.significados, c.nombreClase,p.audio
                  FROM palabras p
                  LEFT JOIN traducciones t ON p.idPalabra = t.idPalabra
                  LEFT JOIN clase c ON p.idClase = c.id
                  WHERE p.idClase = $idClase";
    
        $resultado = $this->conexion->query($query); 
        $palabras = array(); // Inicializamos el arreglo de palabras
        while ($row = $resultado->fetch_assoc()) {
            $palabras[] = $row;
        }
        
        // Comprobar si el arreglo de palabras está vacío
        if(empty($palabras)) {
            return false; // Devolver false si no hay palabras
        } else {
            return $palabras; // Devolver el arreglo de palabras si hay palabras
        }
    }
    public function obtenerIdClase($idPalabra) {
        $query = "SELECT idClase FROM palabras WHERE idPalabra = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $idPalabra);
        $stmt->execute();
        $stmt->bind_result($idClase);
        $stmt->fetch();
        $stmt->close();
    
        return $idClase;
    }
    
    
    public function aniadirDatos($datos) {

         // Insertar la palabra
        $palabra = $datos['palabra'];
        $audio = $datos['audio'];
        $idClase = $datos['idClase'];
        
        $query = "INSERT INTO palabras (idClase, palabra, audio) VALUES ('$idClase', '$palabra', '$audio');";
        
        // Obtener el ID de la palabra insertada
        $query .= "SET @idPalabra = LAST_INSERT_ID();";
        
        // Insertar las traducciones
        for ($i = 1; $i <= $datos['numTraducciones']; $i++) {
            $traduccion = $datos["traduccion".$i];
            $query .= "INSERT INTO traducciones (significados, idPalabra) VALUES ('$traduccion', @idPalabra);";
        }
        
        $this->conexion->multi_query($query);
      
        
    }
    
    
    public function eliminarPalabra($idPalabra) {

    $query = "DELETE FROM palabras WHERE idPalabra = ?";
    $stmt = $this->conexion->prepare($query);
    $stmt->bind_param("i", $idPalabra);
    $stmt->execute();
    $stmt->close();

    }
 public function obtenerPalabra($idPalabra){
    $query = "SELECT p.idPalabra,p.palabra, t.idTraduccion, t.significados, p.audio
    FROM palabras p
    JOIN traducciones t ON p.idPalabra = t.idPalabra
    WHERE p.idPalabra = ".$idPalabra;

$resultado = $this->conexion->query($query);
while ($fila = $resultado->fetch_assoc()) {
    $palabra[] = $fila; // Añadimos cada fila al array $palabra
}
return $palabra; 
}
public function editarPalabra($datos){
    $query = "UPDATE palabras SET palabra = ? ";
    $types = 's'; // Tipo de dato para el primer parámetro
    $params = array(&$datos['palabra']); // Parámetros para el bind_param

    if (!empty($datos['audio'])) {
        $query .= ", audio = ?" ;
        $types .= 's'; // Agregar tipo de dato para el segundo parámetro
        $params[] = &$datos['audio']; // Agregar segundo parámetro al array
    }

    $query .= " WHERE idPalabra = ?";
    $types .= 'i'; // Agregar tipo de dato para el tercer parámetro
    $params[] = &$datos['idPalabra']; // Agregar tercer parámetro al array

    $stmt = $this->conexion->prepare($query);

    // Usar call_user_func_array para pasar los parámetros dinámicamente
    call_user_func_array(array($stmt, 'bind_param'), array_merge(array($types), $params));

    $stmt->execute();
    $stmt->close();

    $query = "UPDATE traducciones SET significados = ? WHERE idTraduccion = ?";
    $stmt = $this->conexion->prepare($query);
    
    foreach ($datos['idTraduccion'] as $id => $idTraduccion) {
        $significado = $datos['traduccion'][$id];
        $stmt->bind_param("si", $significado, $idTraduccion);
        $stmt->execute();
    }
    
    $stmt->close();
}


public function eliminarTraduccion($idTraduccion){
    $query = "DELETE FROM traducciones WHERE idTraduccion = ?";
    $stmt = $this->conexion->prepare($query);
    $stmt->bind_param("i", $idTraduccion);
    $stmt->execute();
    $stmt->close();
}
public function aniadirTraduccion($idPalabra){
    $query = "INSERT INTO traducciones (significados, idPalabra) VALUES (' ', ?)";
    $stmt = $this->conexion->prepare($query);
    $stmt->bind_param("i", $idPalabra);
    $stmt->execute();
    $stmt->close();
}
}
?>
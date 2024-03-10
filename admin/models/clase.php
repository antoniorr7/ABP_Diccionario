<?php
require_once 'models/conexion.php';

class Clase extends Conexion {
    public function __construct() { 
        parent::__construct();
    }

public function listar() {
    $query = "SELECT * FROM clase where idUsuario = ?";
    $stmt = $this->conexion->prepare($query);
    $idUsuario = $_SESSION['idUsuario'];
    $stmt->bind_param("i", $idUsuario);
   
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado === false) {
        return 'Error al consultar la base de datos';
    } else {
        $clases = array(); // Inicializar el array de clases

        if ($resultado->num_rows === 0) {
            return null;
        } else {
            // Recorrer el resultado y almacenar las filas en el array de clases
            while ($fila = $resultado->fetch_assoc()) {
                $clases[] = $fila;
            }
        }
        return $clases;
    }
}

    public function listarClase($id) {
        $query = "SELECT nombreClase,codigo FROM clase where id = $id";
        $resultado = $this->conexion->query($query); 
       
        if ($resultado === false) {
            return 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                return null;
                
            } else {
                foreach ($resultado as $fila) {
                    $clases[] = $fila;
                }
            }
            return $clases;
        }
    }

    public function aniadir ($nombre,$codigo) {
        try {
            $query = "INSERT INTO clase (nombreClase,codigo,idUsuario) VALUES (?,?,?)";
            $stmt = $this->conexion->prepare($query);
    
            // Verificar si la preparación de la consulta fue exitosa
            if ($stmt === false) {
                throw new Exception('Error al preparar la consulta');
            }
    
            // Vincular parámetros
            $stmt->bind_param("ssi", $nombre,$codigo,$_SESSION['idUsuario']);
    
            // Ejecutar la consulta preparada
            $resultado = $stmt->execute();
    
            if ($resultado === false) {
                throw new Exception('Error al insertar en la base de datos');
            } else {
                return 'Clase añadida';
            }
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function borrar ($id) {

        $query = "DELETE FROM clase WHERE id = ?";
        $stmt = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            return 'Error al preparar la consulta';
        }

        // Vincular parámetros
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta preparada
        $resultado = $stmt->execute();
        
    } 
    
    public function editar($id, $nombre, $codigo) {
        try {
            // Preparar la consulta con parámetros
            $query = "UPDATE clase SET nombreClase = ?, codigo = ? WHERE id = ?";
    
            $stmt = $this->conexion->prepare($query);
    
            // Vincular parámetros
            $stmt->bind_param("ssi", $nombre, $codigo, $id);
    
            // Ejecutar la consulta
            $stmt->execute();
        
            // Obtener el número de filas afectadas
        
    
            // Cerrar la sentencia preparada
            $stmt->close();
        
       
          
            
        } catch (Exception $e) {
           if( $e->getCode() == 1062)

            return false;
        }
    }
    
    
}

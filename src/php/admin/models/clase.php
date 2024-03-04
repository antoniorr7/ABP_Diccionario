<?php
require_once 'models/conexion.php';

class Clase extends Conexion {
    public function __construct() { 
        parent::__construct();
    }

    public function listar() {
        $query = "SELECT * FROM clase";
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
    public function listarClase($id) {
        $query = "SELECT nombreClase FROM clase where id = $id";
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

    public function aniadir () {
        
        $query = "INSERT INTO clase (nombreClase) VALUES (?)";
        $stmt = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            return 'Error al preparar la consulta';
        }

        // Vincular parámetros
        $stmt->bind_param("s", $_POST['nombreClase']);

        // Ejecutar la consulta preparada
        $resultado = $stmt->execute();

     
        if ($resultado === false) {
            return 'Error al insertar en la base de datos';
        } else {
            return 'Clase añadida';
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
    //editar
    public function editar($id, $nombre) {
        // Preparar la consulta con parámetros
        $query = "UPDATE clase SET nombreClase = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("si", $nombre, $id);

        // Ejecutar la consulta
        $stmt->execute();
    
        // Verificar si se ejecutó correctamente
        if ($stmt->affected_rows > 0) {
            // Si se modificó al menos una fila, retorna verdadero
            return true;
        } else {
            // Si no se modificó ninguna fila, retorna falso
            return false;
        }
    
        // Cerrar la sentencia preparada
        $stmt->close();
    }
}
?>
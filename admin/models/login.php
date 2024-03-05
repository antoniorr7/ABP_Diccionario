<?php
require_once 'models/conexion.php';

class Login extends Conexion {
    public function __construct() { 
        parent::__construct();
       $this->instalacion();
    }

    public function iniciarSesion($nombreUsuario, $contrasena) {
        $nombreUsuario = $this->conexion->real_escape_string($nombreUsuario);
        $contrasena = $this->conexion->real_escape_string($contrasena);
    
        // Consulta preparada para buscar el usuario en la base de datos
        $query = "SELECT idUsuario, nombreUsuario, contrasena, esAdmin FROM usuarios WHERE nombreUsuario = ?";
        $stmt = $this->conexion->prepare($query);
    
        // Asociar parámetro y ejecutar la consulta
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
    
        // Obtener resultados
        $resultado = $stmt->get_result();
    
        // Verificar si se encontró el usuario
        if ($resultado && $resultado->num_rows > 0) {
            // Obtener el usuario
            $usuario = $resultado->fetch_assoc();
            
            // Verificar la contraseña utilizando password_verify
            if (password_verify($contrasena, $usuario['contrasena'])) {
              
                return $usuario;
            } else {

                return false;
            }
        } else {
            
            return false;
        }
    }
    
    
    public function crearAdmin($nombre, $contrasena) {
        $nombre = $this->conexion->real_escape_string($nombre);
    
        // Encriptar la contraseña antes de almacenarla
        $contrasenia_hash = password_hash($contrasenia, PASSWORD_DEFAULT, ['cost' => 12]);
    
        // Verificar si ya existe algún usuario en la tabla usuarios
        $query = "SELECT COUNT(*) as total FROM usuarios";
        $resultado = $this->conexion->query($query);
        
        if ($resultado && $resultado->fetch_assoc()['total'] == 0) {
            // Si no hay usuarios, crear el usuario admin
            $query = "INSERT INTO usuarios (nombreUsuario, contrasena, esAdmin) VALUES ('$nombre', '$contrasenaEncriptada', 1)";
            $resultado = $this->conexion->query($query);
    
            if ($resultado) {
                return true;
            } else {
                return false;
            }
        } 
    }
    public function instalacion() {
        $query = "SELECT COUNT(*) as total FROM usuarios";
        $resultado = $this->conexion->query($query);
    
        if ($resultado && $resultado->fetch_assoc()['total'] > 0) {
            return; // Ya existen usuarios en la base de datos, no es necesario crear el admin
        } else {
            // No hay usuarios en la base de datos, creamos el admin
            $this->crearUsuario(ADMIN, CONTRASENA);
        }
    }
    
    
    public function crearUsuario($nombre, $contrasena) {
        $nombre = $this->conexion->real_escape_string($nombre);

        // Encriptar la contraseña antes de almacenarla
        $contrasenia_hash = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 12]);
        $query = "INSERT INTO usuarios (nombreUsuario, contrasena, esAdmin) VALUES ('$nombre', '$contrasenia_hash', 0)";
        $resultado = $this->conexion->query($query);
    
        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }
}
?>

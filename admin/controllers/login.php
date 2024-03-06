<?php
class Controladorlogin{
    public $pagina;
    public $view;
    private $modeloLogin;
    public function __construct() {
        require_once 'models/login.php';
        $this->view = '';
        $this->modeloLogin = new Login();
    }
    public function mostrarLogin() {
        $this->view = 'login';
    }
    public function IniciarSesion () {
        session_start();
        
        // Verificar si nombre de usuario o contraseña están vacíos
        if (empty($_POST['nombreUsuario']) || empty($_POST['contrasena'])) {
            // Nombre de usuario o contraseña vacíos, redirigir a login
         header('Location: index.php');
            return;
        }
   
        $nombreUsuario = $_POST['nombreUsuario'];
        $_SESSION['usuario']=$nombreUsuario;
        $contrasena = $_POST['contrasena'];
     
        $resultado = $this->modeloLogin->iniciarSesion($nombreUsuario, $contrasena);
       
           
            
                
        // print("<pre>".print_r($resultado,true)."</pre>");
        if ($resultado !== false) {
            // Inicio de sesión exitoso, obtener los datos del usuario
            $datosUsuario = $resultado;
            
            // Verificar la contraseña utilizando password_verify
            if (password_verify($contrasena, $datosUsuario['contrasena'])) {
                $_SESSION['idUsuario']=$resultado['idUsuario'];
                header('Location: index.php?controller=clase&action=inicio');
              
            } 
        }else {
            
            $this->view = 'login';
            return ['mensaje' => 'Contraseña Incorrecta'];

        }
    }
    public function cerrarSesion() {
        session_start();
        $_SESSION = array(); // Limpiar todas las variables de sesión
        session_destroy(); // Destruir la sesión
        header('Location: index.php');
        exit(); // Detener la ejecución del script después de la redirección
    }
    

    public function mostrarRegistro() {
        $this->view = 'registro';
    }
    
    public function crearUsuario() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombreUsuario"];
            $contrasena = $_POST["contrasena"];
    
            $resultado = $this->modeloLogin->crearUsuario($nombre, $contrasena);
    
            if ($resultado == true) {
                $this->view = 'login';
            } else {
                return "Error al crear el Usuario.";
            }
        }
    }
    public function comprobarSesion() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php');
        }
    }
    
}
?>
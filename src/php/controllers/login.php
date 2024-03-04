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
            $this->view = 'error';
            return;
        }
    
        $nombreUsuario = $_POST['nombreUsuario'];
        $contrasena = $_POST['contrasena'];
    
        $resultado = $this->modeloLogin->iniciarSesion($nombreUsuario, $contrasena);
        // print("<pre>".print_r($resultado,true)."</pre>");
        if ($resultado !== false) {
            // Inicio de sesión exitoso, obtener los datos del usuario
            $datosUsuario = $resultado;
            
            // Verificar la contraseña utilizando password_verify
            if (password_verify($contrasena, $datosUsuario['contrasena'])) {

                $this->view='inicio';
                echo "Inicio de sesión exitoso.";
            } 
        }else {
            
            $this->view = 'login';
            return ['mensaje' => 'Contraseña Incorrecta'];

        }
    }
       
    

    public function crearAdmin() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombreUsuario"];
            $correo = $_POST["correo"];
            $contrasena = $_POST["contrasena"];

            // Llama al método para crear un administrador
            $resultado = $this->modeloLogin->crearAdmin($nombre, $correo, $contrasena);

            if ($resultado) {
                echo "Administrador creado correctamente.";
            } else {
                echo "Error al crear el administrador.";
            }
        }
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
    
}
?>
<?php
class Controladorclase{
    public $pagina;
    public $view;
    private $modeloClase;
    private $objLogin;
    public function __construct() {
        require_once 'models/clase.php';
        require_once 'login.php';
        $this->view = '';
        $this->modeloClase = new Clase();
        $this->objLogin = new Controladorlogin();
        $this->objLogin->comprobarSesion();
    }
    public function inicio() {
       
        $this->view = 'inicio';
     
    }

    public function listarClases() {
       
        $this->view = 'clase';
        return $this->modeloClase->listar(); 
    }
    public function listarClase($id) {
       
        return $this->modeloClase->listarClase($id); 
    }
    public function formularioClase() {
       
        $this->view = 'aniadirclase';
    }
    public function aniadirClases(){
        if (isset($_POST['nombreClase']) && !empty(trim($_POST['nombreClase'])) && isset($_POST['codigo']) && !empty(trim($_POST['codigo']))) {
            // Verificar longitud del nombre de la clase
            $nombreClase = $_POST['nombreClase'];
            if (strlen($nombreClase) > 50) {
                $this->view='error';
                return "El nombre de la clase no puede tener más de 50 caracteres.";
            }
            $codigo = $_POST['codigo'];
            if (strlen($codigo) > 5) {
                $this->view='error';
                return "El codigo de la clase no puede tener más de 5 caracteres."; 
            }
            
          
            if ($this->modeloClase->aniadir($nombreClase,$codigo)==false) {
               $this->view='error';
               return 'clase o codigo duplicados';
            } 
            header('Location: index.php?action=listarClases&controller=clase');
        } else {
            $this->view='error';
            return "El nombre de la clase o el codigo no pueden estar vacíos.";
        }
        
    }
    
    public function eliminarClase(){
        $this->view = 'eliminarclase';
       
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'si') {
             
                    $this->modeloClase->borrar($_GET['id']);
                   header('Location:index.php?action=listarClases&controller=clase');

            }
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'no') {
                header('Location: index.php?action=listarClases&controller=clase');
            }

    }
    
    public function obtenerEditar(){
        $this->view = 'editarclase';
        return $clase =  ($this->listarClase($_GET['id']));
    }
    public function editarClases() {
        $this->view = 'clase';
        
        // Verificar si se ha enviado el nombre de la clase
        if(empty(trim($_POST['nombreClase'])) || empty(trim($_POST['codigo']))) {
            $this->view = 'error';
            return "El nombre de la clase o el codigo no pueden estar vacíos.";
        }
        
        // Verificar longitud del nombre de la clase
        $nombreClase = $_POST['nombreClase'];
        if (strlen($nombreClase) > 50) {
            $this->view = 'error';
            return "El nombre de la clase no puede tener más de 50 caracteres.";
        }
        $codigo = $_POST['codigo'];
       
        if (strlen($codigo) > 5) {
            $this->view='error';
            return "El codigo de la clase no puede tener más de 5 caracteres."; 
        }
        
        
        // Realizar la edición solo si el nombre de la clase no está vacío y no excede la longitud máxima
        if ($this->modeloClase->editar($_POST['id'], $nombreClase, $codigo)==false) {
            $this->view='error';
            return 'clase o código ya existente';
        }
 
        header('Location: index.php?action=listarClases&controller=clase');
    }
    
}

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
     
        if (isset($_POST['nombreClase']) && !empty($_POST['nombreClase'])) {
         
            $this->modeloClase->aniadir($_POST['nombreClase']);
    
            header('Location: index.php?action=listarClases&controller=clase');
        }else{
            $this->view='error';
            return "El nombre de la clase no puede estar vacío.";
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
        if(empty(trim($_POST['nombreClase']))) {
            $this->view = 'error';
            return "El nombre de la clase no puede estar vacío.";
        }
        
        // Realizar la edición solo si el nombre de la clase no está vacío
        $this->modeloClase->editar($_POST['id'], $_POST['nombreClase']);
    
        header('Location: index.php?action=listarClases&controller=clase');
    }
    
    
}
?>
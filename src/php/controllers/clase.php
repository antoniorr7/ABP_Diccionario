<?php
class Controladorclase{
    public $pagina;
    public $view;
    private $objClases;
    public function __construct() {
        require_once 'models/clase.php';
        $this->view = '';
        $this->objClases = new Clase();
    }
    public function inicio() {
        $this->view = 'inicio';
    }

    public function listarClases() {
        $this->view = 'clase';
        return $this->objClases->listar(); 
    }
    public function aniadirClases(){
        $this->view = 'aniadirclase';
        if (isset($_POST['nombreClase']) && !empty($_POST['nombreClase'])) {
         
            $this->objClases->aniadir($_POST['nombreClase']);
    
            header('Location: index.php?action=listarClases&controller=clase');
        }
    }
    public function eliminarClase(){
        $this->view = 'eliminarclase';
       
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'si') {
             
                    $this->objClases->borrar($_GET['id']);
                   header('Location:index.php?action=listarClases&controller=clase');

            }
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'no') {
                header('Location: index.php?action=listarClases&controller=clase');
            }

    }
    public function editarClases(){
        $this->view = 'editarclase';
        if (isset($_POST['nombreClase']) && !empty($_POST['nombreClase'])) {

            $this->objClases->editar($_POST['id'],$_POST['nombreClase']);

            header('Location: index.php?action=listarClases&controller=clase');
        }
    }
}
?>
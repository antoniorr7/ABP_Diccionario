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
        $nombreClase = $_POST['nombreClase'];
        $codigo = $_POST['codigo'];
        $resultado = $this->modeloClase->aniadir($nombreClase,$codigo);
     echo $resultado;
        if($resultado === true){
           header('Location: index.php?action=listarClases&controller=clase');
            exit();
        }else{
            return $this->obtenerMensajeError($resultado);
        }
        // if (isset($_POST['nombreClase']) && !empty(trim($_POST['nombreClase'])) && isset($_POST['codigo']) && !empty(trim($_POST['codigo']))) {
        //     // Verificar longitud del nombre de la clase
        //     $nombreClase = $_POST['nombreClase'];
        //     if (strlen($nombreClase) > 50) {
        //         $this->view='error';
        //         return "El nombre de la clase no puede tener más de 50 caracteres.";
        //     }
        //     $codigo = $_POST['codigo'];
        //     if (strlen($codigo) > 5) {
        //         $this->view='error';
        //         return "El codigo de la clase no puede tener más de 5 caracteres."; 
        //     }
            
          
        //     if ($this->modeloClase->aniadir($nombreClase,$codigo)==false) {
        //        $this->view='error';
        //        return 'clase o codigo duplicados';
        //     } 
        //     header('Location: index.php?action=listarClases&controller=clase');
        // } else {
        //     $this->view='error';
        //     return "El nombre de la clase o el codigo no pueden estar vacíos.";
        // }
        
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
        $nombreClase = $_POST['nombreClase'];
        $codigo = $_POST['codigo'];
        $resultado = $this->modeloClase->editar($_POST['id'], $nombreClase, $codigo);
        if($resultado === true){
            header('Location: index.php?action=listarClases&controller=clase');
             exit();
         }else{
        
             return $this->obtenerMensajeError($resultado);
         }
        // Verificar si se ha enviado el nombre de la clase
        // if(empty(trim($_POST['nombreClase'])) || empty(trim($_POST['codigo']))) {
        //     $this->view = 'error';
        //     return "El nombre de la clase o el codigo no pueden estar vacíos.";
        // }
        
        // // Verificar longitud del nombre de la clase
        // $nombreClase = $_POST['nombreClase'];
        // if (strlen($nombreClase) > 50) {
        //     $this->view = 'error';
        //     return "El nombre de la clase no puede tener más de 50 caracteres.";
        // }
        // $codigo = $_POST['codigo'];
       
        // if (strlen($codigo) > 5) {
        //     $this->view='error';
        //     return "El codigo de la clase no puede tener más de 5 caracteres."; 
        // }
        
    
        // if ($this->modeloClase->editar($_POST['id'], $nombreClase, $codigo) === false) {
        //     $this->view='error';
        //     return 'clase o código ya existente';
        // }
 
        // header('Location: index.php?action=listarClases&controller=clase');
    }
    public function obtenerMensajeError($codigoError) {
        
        $this->view = 'error'; 
       echo $codigoError;
        switch ($codigoError) {
            case 1048:
                return "Error al procesar el formulario: No puede haber campos vacíos.";
                break;
            case 1406:
                return "Error al procesar el formulario: Los campos exceden la longitud máxima.";
                break;
            case 1062:
               
                return "Error al procesar el formulario: Ya existe una clase con ese nombre o código.";
                break;  
            default:
                if (is_numeric($codigoError)) {
                    return "Error al crear la clase. Código de error: $codigoError";
                } else { 
                    return $codigoError;
                }
                break;
        }
        
    }
}

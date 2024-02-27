<?php
class Controladorpalabra{
    public $pagina;
    public $view;
    private $modeloPalabra;
    public function __construct() {
        require_once 'models/palabra.php';
        $this->view = '';
        $this->modeloPalabra = new Palabra();
    }
  public function listarPalabras(){
        $this->view = 'palabra';
        
        return $this->modeloPalabra->listarPalabras($_GET['idClase']);
    }
    public function PDF (){
        $this->view = 'pdf';
        return $this->modeloPalabra->listarPalabras($_GET['idClase']);
        
    }
    public function aniadirPalabra(){
        $this->view = 'aniadirpalabra';
    }
    public function aniadirTraducciones(){
        $this->view = 'aniadirtraducciones';
        
    }
    public function guardarPalabra(){
        $audio_base64 = "";
        if(isset($_FILES['audio'])){
            $audio_tmp_name = $_FILES['audio']['tmp_name'];
            $audio_name = $_FILES['audio']['name'];
            
            // Verificar si el nombre del archivo termina con ".mp3"
            if (strtolower(pathinfo($audio_name, PATHINFO_EXTENSION)) === 'mp3') {
                $audio_data = file_get_contents($audio_tmp_name);
                $audio_base64 = base64_encode($audio_data);
            } else {
                // Si el archivo no es un MP3, establecer audio_base64 como null
                $audio_base64 = null;
            }
    
            $_POST['audio'] = $audio_base64;
            
            // Llamar al método aniadirPalabra para insertar la palabra y obtener el ID
            $idPalabra = $this->modeloPalabra->aniadirPalabra($_POST);
            
            // Llamar al método aniadirTraducciones para insertar las traducciones
            if ($idPalabra) {
                $this->modeloPalabra->aniadirTraducciones($idPalabra, $_POST);
            }
           
            
            header("Location: index.php?controller=palabra&action=listarPalabras&idClase=".$_POST['idClase']);
           
        }
    }
    
    
    
    public function eliminarPalabra(){
        $this->view = 'eliminarpalabra';
        $idClase=$this->modeloPalabra->obtenerIdClase($_GET['idPalabra']);
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'si') {
             
                    $this->modeloPalabra->eliminarPalabra($_GET['idPalabra']);
                    header("Location: index.php?controller=palabra&action=listarPalabras&idClase=".$idClase);

            }
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'no') {
                header("Location: index.php?controller=palabra&action=listarPalabras&idClase=".$idClase);
            }

    }
    public function rellenarEditar(){
        $this->view = 'editarpalabra';
        
        return $this->modeloPalabra->obtenerPalabra($_GET['idPalabra']);

    }
    public function editarPalabra(){
        $idClase = $this->modeloPalabra->obtenerIdClase($_GET['idPalabra']);
        $audio_base64 = "";
        if(isset($_FILES['audio'])){
            $audio_tmp_name = $_FILES['audio']['tmp_name'];
            $audio_name = $_FILES['audio']['name'];
            
            // Verificar si el nombre del archivo termina con ".mp3"
            if (strtolower(pathinfo($audio_name, PATHINFO_EXTENSION)) === 'mp3') {
                $audio_data = file_get_contents($audio_tmp_name);
                $audio_base64 = base64_encode($audio_data);
            } else {
                // Si el archivo no es un MP3, establecer audio_base64 como null
                $audio_base64 = null;
            }
        }
    
        $_POST['audio'] = $audio_base64;
        $this->modeloPalabra->editarPalabra($_POST);
        
        header("Location: index.php?controller=palabra&action=listarPalabras&idClase=".$idClase);
        exit(); // Es buena práctica salir después de redireccionar
    }
    
    public function eliminarTraduccion(){
        $this->view = 'editarpalabra';
        
         $this->modeloPalabra->eliminarTraduccion($_GET['idTraduccion']);
         header("Location: index.php?controller=palabra&action=rellenarEditar&idPalabra=".$_GET['idPalabra']);
    }
   public function aniadirTraduccion(){
        $this->view = 'editarpalabra';

         $this->modeloPalabra->aniadirTraduccion($_GET['idPalabra']);
         header("Location: index.php?controller=palabra&action=rellenarEditar&idPalabra=".$_GET['idPalabra']);
    }
}

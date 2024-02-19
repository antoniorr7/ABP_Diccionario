<?php
class Controladorpalabra{
    public $pagina;
    public $view;
    private $objPalabra;
    public function __construct() {
        require_once 'models/palabra.php';
        $this->view = '';
        $this->objPalabra = new Palabra();
    }
    public function listarPalabras() {
        $this->view = 'palabra';
        return $this->objPalabra->listar($_GET['idClase']);

    }
public function aniadirPalabra(){
    $this->view = 'aniadirPalabra';
    
    if (isset($_POST['palabra'], $_POST['idClase'])) {
        $idClase = $_POST['idClase'];
        $palabra = $_POST['palabra'];
        $audio64 = null;
        
        // Verificar si se ha enviado un archivo de audio
        if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
            $audio = $_FILES['audio']['tmp_name']; // Obtener la ruta temporal del archivo de audio
            $audio64 = base64_encode(file_get_contents($audio)); // Convertir el archivo a base64
        }
        
        // Verificar si el idClase es un valor válido
        if (!empty($palabra)) {
            // Llamar al método del modelo y pasar el idClase como argumento
            $this->objPalabra->aniadir($idClase, $palabra, $audio64);
            header("Location: index.php?action=listarPalabras&controller=palabra&nombreClase=" . $_POST['nombreClase']. "&idClase=".$_POST['idClase']);
        } 
    }
}

    public function eliminarPalabra(){
        $this->view = 'eliminarpalabra';
       
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'si') {
             
                    $this->objPalabra->borrar($_GET['idPalabra']);
                    header("Location: index.php?action=listarPalabras&controller=palabra&nombreClase=" . $_POST['nombreClase']. "&idClase=".$_POST['idClase']);

            }
            if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'no') {
                header("Location: index.php?action=listarPalabras&controller=palabra&nombreClase=" . $_POST['nombreClase']. "&idClase=".$_POST['idClase']);
            }

    }
    public function editarPalabra(){
        $this->view = 'editarpalabra';
    
        if (isset($_POST['idPalabra'], $_POST['nombreClase'], $_POST['palabra']) && !empty($_POST['palabra'])) {
            $this->objPalabra->editar($_POST['idPalabra'], $_POST['palabra']);
            // Descomentar la siguiente línea para redireccionar después de editar la palabra
             header("Location: index.php?action=listarPalabras&controller=palabra&nombreClase=" . $_POST['nombreClase']. "&idClase=".$_POST['idClase']);
        } else {
            // Manejar el caso en que los datos necesarios no estén presentes o sean inválidos
        }
    }
}
?>
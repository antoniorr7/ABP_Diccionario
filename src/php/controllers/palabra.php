<?php
  use Dompdf\Dompdf;
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
    public function PDF() {
        $datos = $this->modeloPalabra->listarPalabras($_GET['idClase']);
        ob_start();
        echo "<h1>{$datos[0]['nombreClase']}</h1>";
        echo '<div class="panel-administracion">';
        $palabras_mostradas = [];
        foreach ($datos as $palabra) {
            if (!in_array($palabra['palabra'], $palabras_mostradas)) {
                $palabras_mostradas[] = $palabra['palabra'];
                echo '<div class="clase"><h2><div id="palabra">' . $palabra['palabra'];
                if (isset($palabra['audio']) && !empty($palabra['audio'])) {
                    $audio_decoded = base64_decode($palabra['audio']);
                    $audio_data_uri = 'data:audio/mpeg;base64,' . base64_encode($audio_decoded);
                    echo '<div class="audio-container"><audio controls><source src="' . $audio_data_uri . '" type="audio/mpeg"></audio></div>';
                }
                echo '</div></h2><ul>';
                foreach ($datos as $info) {
                    if ($info['palabra'] === $palabra['palabra']) {
                        echo '<li>' . ($info['significados'] === NULL ? 'No hay significados' : $info['significados']) . '</li>';
                    }
                }
                echo '</ul></div>';
            }
        }
        echo '</div>';
        $html = ob_get_clean();
        require_once '../php/library/dompdf/autoload.inc.php';
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set(['isRemoteEnabled' => true]);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter');
        $dompdf->render();
        $dompdf->stream("{$datos[0]['nombreClase']}.pdf", ['Attachment' => 0]);
    }
    
    public function aniadirPalabra(){
        $this->view = 'aniadirpalabra';
    }
    public function aniadirTraducciones(){
        $this->view = 'aniadirtraducciones';
        
    }
    public function guardarPalabra() {
        // Verificar si se ha enviado algún archivo de audio
        if(isset($_FILES['audio']) && $_FILES['audio']['size'] > 0) {
            $audio_tmp_name = $_FILES['audio']['tmp_name'];
            $audio_name = $_FILES['audio']['name'];
            
            // Verificar si el archivo es de tipo MP3
            if (strtolower(pathinfo($audio_name, PATHINFO_EXTENSION)) === 'mp3') {
                $audio_data = file_get_contents($audio_tmp_name);
                $audio_base64 = base64_encode($audio_data);
                
                $_POST['audio'] = $audio_base64;
            } else {
                // Si el archivo no es un MP3, mostrar un mensaje de error
                $this->view= 'error';
                return "El archivo de audio debe ser un archivo de audio .mp3";
            }
        } else {
            // Si no se proporcionó ningún archivo de audio, establecer el valor del campo de audio como null
            $_POST['audio'] = null;
        }
        
        // Llamar al método aniadirPalabra para insertar la palabra y obtener el ID
        $idPalabra = $this->modeloPalabra->aniadirPalabra($_POST);
        
        // Llamar al método aniadirTraducciones para insertar las traducciones
        if ($idPalabra) {
            $this->modeloPalabra->aniadirTraducciones($idPalabra, $_POST);
        }
        
        header("Location: index.php?controller=palabra&action=listarPalabras&idClase=".$_POST['idClase']);
        exit(); // Detener la ejecución después de la redirección
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

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
        if (empty($datos[0]['significados'])) {
            $this->view= 'error';
            return 'no se puede generar el pdf porque no existen palabras';
        }
 
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
        if($_POST['numTraducciones'] > 0 && !empty($_POST['palabra']) && is_numeric($_POST['numTraducciones'])) {
            $this->view = 'aniadirtraducciones';
            
        // print("<pre>".print_r($_GET,true)."</pre>");
        // print("<pre>".print_r($_POST,true)."</pre>");
        }else{
            $this->view='aniadirpalabra';
            
            return 'error'; 
        }

        
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
                $this->view= 'aniadirtraducciones';
                return "El archivo de audio debe ser un archivo de audio .mp3";
            }
        } else {
            // Si no se proporcionó ningún archivo de audio, establecer el valor del campo de audio como null
            $_POST['audio'] = null;
        }
        // Verificar si hay traducciones vacías
    $numTraducciones = $_POST['numTraducciones'];
    $traducciones = array();
    for ($i = 1; $i <= $numTraducciones; $i++) {
        $traduccionKey = 'traduccion'.$i;
        $traducciones[] = $_POST[$traduccionKey];
    }
    
    foreach ($traducciones as $traduccion) {
        if (empty($traduccion)) {
            $this->view= 'aniadirtraducciones';
            return "Una o más traducciones están vacías";
        }
    }
        // Llamar al método aniadirPalabra para insertar la palabra y obtener el ID
        $idPalabra = $this->modeloPalabra->aniadirPalabra($_POST);
        
        // Llamar al método aniadirTraducciones para insertar las traducciones
        if ($idPalabra) {
            $this->modeloPalabra->aniadirTraducciones($idPalabra, $_POST);
        }
        // $this->view = 'palabra';
        // return $this->modeloPalabra->listarPalabras($_POST['idClase']);
        //si uso header se rompe todo lo que cojo en la vista con get
       
        header("Location: index.php?controller=palabra&action=listarPalabras&idClase=".$_POST['idClase']);
        exit(); 
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
    public function editarPalabra() {
      
        $idClase = $this->modeloPalabra->obtenerIdClase($_GET['idPalabra']);
        $audio_base64 = "";
     // Comprobar si la palabra está vacía
     if(empty(trim($_POST['palabra']))) {
        $this->view = 'error';
        return "La palabra no puede estar vacía.";
    }

        // Comprobar si se ha enviado un archivo de audio
        if(isset($_FILES['audio']) && $_FILES['audio']['size'] > 0) {
            $audio_tmp_name = $_FILES['audio']['tmp_name'];
            $audio_name = $_FILES['audio']['name'];
            
            // Verificar si el nombre del archivo termina con ".mp3"
            if (strtolower(pathinfo($audio_name, PATHINFO_EXTENSION)) === 'mp3' ) {
                $audio_data = file_get_contents($audio_tmp_name);
                $audio_base64 = base64_encode($audio_data);
            } else {
                $this->view='error';
                return "El archivo de audio debe ser un archivo de audio .mp3";
            }
        }
        
       
     // Bandera para verificar si al menos una traducción no está vacía
     $hayTraduccion = false;
    
     // Comprobar si hay traducciones vacías
     foreach($_POST['traduccion'] as $index => $traduccion) {
         if(empty(trim($traduccion))) {
             // Eliminar la traducción correspondiente de la base de datos
             $this->modeloPalabra->eliminarTraduccion($_POST['idTraduccion'][$index]);
         } else {
             // Se encontró al menos una traducción no vacía
             $hayTraduccion = true;
         }
     }
     
     // Si no hay al menos una traducción no vacía, devuelve un error
     if(!$hayTraduccion) {
         $this->view = 'error';
         return "Debe haber al menos una traducción no vacía.";
     }
    
        $_POST['audio'] = $audio_base64;
        $this->modeloPalabra->editarPalabra($_POST);
        
        header("Location: index.php?controller=palabra&action=listarPalabras&idClase=".$idClase);
        exit(); 
    }
    
    
    
    
    public function eliminarTraduccion(){
        $this->view = 'editarpalabra';
        
         $this->modeloPalabra->eliminarTraduccion($_GET['idTraduccion']);
         header("Location: index.php?controller=palabra&action=rellenarEditar&idPalabra=".$_GET['idPalabra']."&idClase=".$_GET['idClase']);
    }
   public function aniadirTraduccion(){
        $this->view = 'editarpalabra';

         $this->modeloPalabra->aniadirTraduccion($_GET['idPalabra']);
         header("Location: index.php?controller=palabra&action=rellenarEditar&idPalabra=".$_GET['idPalabra']."&idClase=".$_GET['idClase']);
    }
    public function buscarPalabra(){
        $this->view = 'busqueda';

        return $this->modeloPalabra->buscarPalabras($_POST['busqueda']);
    }
    
}

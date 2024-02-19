<?php
class Controladortraduccion{
    public $pagina;
    public $view;
    private $objTraduccion;
    public function __construct() {
        require_once 'models/traduccion.php';
        $this->view = '';
        $this->objTraduccion = new Traduccion();
    }
    public function listarTraduccion() {
        $this->view = 'traduccion';
        return $this->objTraduccion->listar($_GET['idPalabra']);
    }
    public function aniadirTraduccion() {
        $this->view = 'aniadirtraduccion';
        if (isset($_POST['traduccion']) && !empty($_POST['traduccion'])) {
         
             $this->objTraduccion->aniadir($_POST['idPalabra'], $_POST['traduccion']);
             header('Location: index.php?action=listarTraduccion&controller=traduccion&idPalabra='.$_POST['idPalabra'].'&palabra='.$_POST['palabra']);
        }
      
    }
    public function eliminarTraduccion() {
        $this->view = 'eliminartraduccion';
       
        if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'si') {
         
                $this->objTraduccion->borrar($_GET['idTraduccion']);
                header('Location: index.php?action=listarTraduccion&controller=traduccion&idPalabra='.$_POST['idPalabra'].'&palabra='.$_POST['palabra']);

        }
        if (isset($_POST['confirmarBorrado']) && $_POST['confirmarBorrado'] === 'no') {
            header("Location: index.php");
        }

     
    }
}
?>
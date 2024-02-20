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
  public function listarPalabras(){
        $this->view = 'palabra';
        return $this->objPalabra->listarPalabras($_GET['idClase']);
    }
}
?>
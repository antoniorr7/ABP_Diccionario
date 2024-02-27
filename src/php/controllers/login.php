<?php
class Controladorlogin{
    public $pagina;
    public $view;
    private $objClases;
    public function __construct() {
        require_once 'models/login.php';
        $this->view = '';
        $this->objClases = new Login();
    }
    public function mostrarLogin() {
        $this->view = 'login';
    }

}
?>
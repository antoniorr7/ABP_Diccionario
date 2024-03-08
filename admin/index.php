<?php
require_once 'config/config.php';
    // Configuración por defecto
    $controladorPorDefecto = constant("ControladorporDefecto");
    $metodoPorDefecto = constant("MetodoporDefecto");
    // Verificar y asignar valores a $_GET del controlador y método
    if(!isset($_GET["controller"])){
        $_GET["controller"] = constant("ControladorporDefecto");
    }
    if(!isset($_GET["action"])) {
        $_GET["action"] = constant("MetodoporDefecto");
    }
    // Construir la ruta del controlador
    $rutaControlador = 'controllers/' . $_GET["controller"] . '.php';
    // Verificar si el controlador existe, si no usa el por defecto
    if (!file_exists($rutaControlador)) {
        $rutaControlador = 'controllers/' . $controladorPorDefecto . '.php';
    }
    // Cargar el controlador
    require_once $rutaControlador;
    $controladorNombre = 'Controlador' . $_GET["controller"];
    $controlador = new $controladorNombre();

    // Llamada al metodo y guarda los datos en $retornado   
        $retornado = $controlador->{$_GET["action"]}();
// Cargar las vistas
//controlar el menu
if ($controlador->view === 'login' || $controlador->view === 'pdf'  || $controlador->view === 'registro' || $controlador->view === 'registroa') {
    require_once 'views/' . $controlador->view . '.php';
}else{
    require_once 'views/templates/header.php';
    require_once 'views/' . $controlador->view . '.php';
    require_once 'views/templates/footer.php';
}
?>
<div id="mensajeContainer">
    <h1 id="mensaje"><?php echo $retornado; ?></h1>
</div>

<?php
// Verificar si idPalabra y idClase están presentes en $_POST
if(isset($_POST['idPalabra']) && isset($_POST['idClase'])) {
    $idPalabra = $_POST['idPalabra'];
    $idClase = $_POST['idClase'];
    // Construir la URL con los valores de idPalabra y idClase y el action rellenarEditar
    $url = 'index.php?action=rellenarEditar&controller=palabra&idPalabra=' . $idPalabra . '&idClase=' . $idClase;
    // Mostrar el enlace
    echo '<a href="'.$url.'">volver al inicio</a>';
} elseif(isset($_POST['idClase'])) { // Verificar si idClase está presente en $_POST
    $idClase = $_POST['idClase'];
    // Construir la URL con el idClase y el action listarPalabras
    $url = 'index.php?action=listarPalabras&controller=palabra&idClase=' . $idClase;
    // Mostrar el enlace
    echo '<a href="'.$url.'">volver al inicio</a>';
} elseif (isset($_SESSION['usuario'])) { // Verificar si hay una sesión de usuario activa
    echo '<a href="index.php?action=listarClases&controller=clase">volver al inicio</a>';
} else {
    echo '<a href="index.php?action=mostrarLogin&controller=login">volver al inicio</a>';
}

?>


<div id="mensajeContainer">
    <h1 id="mensaje"><?php echo $retornado; ?></h1>
</div>

<?php
// Verificar si idClase está presente en $_POST
if(isset($_POST['idClase'])) {
    $idClase = $_POST['idClase'];
    // Construir la URL con el idClase
    $url = 'index.php?action=listarPalabras&controller=palabra&idClase=' . $idClase;
    // Mostrar el enlace
    echo '<a href="'.$url.'">volver al inicio</a>';
} else {
    // Si no se proporciona idClase en POST, mostrar el enlace sin modificaciones
    echo '<a href="index.php?action=listarClases&controller=clase">volver al inicio</a>';
}
?>
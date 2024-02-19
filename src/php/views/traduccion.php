<?php

if ($retornado === null) {
    echo "No se encontraron traducciones para  ".$retornado ;
} else {
    echo "<h2>" . $_GET['palabra'] . "</h2>"; // Título de la traducción
    foreach ($retornado as $traduccion) {
        echo '<div class="word-container">';
        echo '<div class="meanings">';
        echo '<div class="meaning">';
        
        // Aquí podrías obtener el contenido de la traducción dinámicamente
        echo "<p>" . $traduccion['significados'] . "</p>";
        echo '<a class href="index.php?controller=traduccion&action=eliminarTraduccion&idPalabra=' . $_GET['idPalabra'] . '&palabra=' . $_GET['palabra']. '&idTraduccion=' . $traduccion['idTraduccion'] . '"> eliminar</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
   

   // echo '<a id="tran" class="btn-petit" href="index.php?controller=traduccion&action=aniadirTraduccion&idPalabra=' . $_GET['idPalabra'] . '&palabra=' . $_GET['palabra']. '">Añadir nueva traducción</a>';

?>
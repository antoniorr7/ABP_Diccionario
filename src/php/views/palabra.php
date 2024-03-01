<?php
// Verificar si $retornado está vacío
if (isset($retornado['mensaje'])) {
    echo $retornado['mensaje'];
} else {
?>
    <h1><?php
        foreach ($retornado as $indice) {
            $nombreClase = $indice['nombreClase'];
        }
        echo $nombreClase; ?></h1>
        
    <div class="panel-administracion">
        <?php
        // Array para llevar un registro de las palabras mostradas
        $palabras_mostradas = array();

        // Iterar sobre el arreglo retornado
        foreach ($retornado as $palabra) :
            // Verificar si la palabra ya ha sido mostrada
            if (!in_array($palabra['palabra'], $palabras_mostradas)) {
                // Agregar la palabra al array de palabras mostradas
                $palabras_mostradas[] = $palabra['palabra'];
        ?>
                <!-- Div para mostrar la palabra y sus significados -->
                <div class="clase">
                <h2>
                    <div id=palabra>
                    <?php echo $palabra['palabra'];
                  if(isset($palabra['audio']) && !empty($palabra['audio'])) {
                    $audio_decoded = base64_decode($palabra['audio']);
                    $audio_data_uri = 'data:audio/mpeg;base64,' . base64_encode($audio_decoded);
                    echo '<div class=audio-container>';
                    echo '<audio controls>
                            <source src="' . $audio_data_uri . '" type="audio/mpeg">
                          </audio>
                          </div>';
                } 
                    ?>
                    </div>
                    <div class=action>
                         <a href="index.php?action=rellenarEditar&controller=palabra&idPalabra=<?php echo $palabra['idPalabra']; ?>&idClase=<?php echo $_GET['idClase']; ?>" id="btnEditarPalabra"><img src="../img/lapiz.png" alt="atras"></a>
                         <a href="index.php?action=eliminarPalabra&controller=palabra&idPalabra=<?php echo $palabra['idPalabra']; ?>&idClase=<?php echo $_GET['idClase']; ?>" id="btnEliminarPalabra"><img src="../img/borrar.png" alt="atras"></a>

                    </div>
                </h2>
                    <ul>
                        <?php
                        // Iterar nuevamente para mostrar todos los significados de la palabra actual
                        foreach ($retornado as $datos) :
                            // Verificar si el dato actual corresponde a la palabra actual
                            if ($datos['palabra'] === $palabra['palabra']) :
                                if ($datos['significados'] === NULL) {
                                    echo "<li>No hay significados</li>";
                                } else {
                                    echo "<li>" . $datos['significados'] . "</li>";

                                }
                            endif;
                        endforeach;
                        ?>
                    </ul>
                </div>
        <?php
            }
        endforeach;
        ?>
    </div>
    
<?php } ?>

<!-- Enlace para añadir una nueva palabra -->
<div id=abajo>
<a href="index.php?action=aniadirPalabra&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>" id="btnAgregarPalabra">Añadir Palabra</a>
<a id=pdf href="index.php?action=PDF&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>">PDF</a>
</div>
<a  href="index.php?action=listarClases&controller=clase"><img id="atras" src="../img/flecha-izquierda.png" alt=""></a>


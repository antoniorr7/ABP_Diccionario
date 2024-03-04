<?php
// Verificar si $retornado está vacío
if (isset($retornado['mensaje'])) {
    echo $retornado['mensaje'];
} else {
?>
    <div class="panel-administracion">
        <?php
        // Iterar sobre el arreglo retornado
        foreach ($retornado as $palabra) :
        ?>
            <!-- Div para mostrar la palabra y sus significados -->
            <div class="clase">
                <h2>
                    <div id="palabra">
                        <?php echo $palabra['palabra']; ?>
                        <?php 
                        if(isset($palabra['audio']) && !empty($palabra['audio'])) {
                            $audio_decoded = base64_decode($palabra['audio']);
                            $audio_data_uri = 'data:audio/mpeg;base64,' . base64_encode($audio_decoded);
                            echo '<div class="audio-container">';
                            echo '<audio controls>
                                    <source src="' . $audio_data_uri . '" type="audio/mpeg">
                                  </audio>
                                  </div>';
                        } 
                        ?>
                    </div>
                </h2>
                <ul>
                    <?php
                    // Verificar si hay significados y mostrarlos
                    if ($palabra['significados'] === NULL) {
                        echo "<li>No hay significados</li>";
                    } else {
                        echo "<li>" . $palabra['significados'] . "</li>";
                    }
                    ?>
                </ul>
            </div>
        <?php
        endforeach;
        ?>
    </div>
   
<?php } ?>
<a  href="index.php?action=listarClases&controller=clase"><img id="atras" src="../img/flecha-izquierda.png" alt=""></a>
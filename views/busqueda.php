  <div class="container">
    <?php
    // Verificar si $retornado está vacío
    if (isset($retornado['mensaje'])) {
        echo $retornado['mensaje'];
    } else {
    ?>
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
                            <div id="palabra">
                                <?php echo $palabra['palabra'];
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

    <!-- Enlaces eliminados para la administración -->
    <div id="abajo">
        <!-- <a href="index.php?action=aniadirPalabra&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>" id="btnAgregarPalabra" class="btn btn-primary">Añadir Palabra</a> -->
    </div> 
    <a href="index.php?action=listarClases&controller=clase" class="btn btn-info"><img id="atras" src="img/flecha-izquierda.png" alt=""></a>
  </div>

  <!-- Scripts de Bootstrap y otros -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

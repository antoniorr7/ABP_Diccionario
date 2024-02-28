<?php
ob_start();

echo '<h1>';
foreach ($retornado as $indice) {
    $nombreClase = $indice['nombreClase'];
}
echo $nombreClase;
echo '</h1>';

  echo'  <div class="panel-administracion">';
     
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
<?php  $html=ob_get_clean();
// Importo libreria dompdf
require_once '../php/library/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
// Crear instancia de Dompdf
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
// Renderizar HTML en PDF
$dompdf->setPaper('letter');
$dompdf->render();
// Guardar PDF en disco
$dompdf->stream("$nombreClase.pdf", array('Attachment' => 0));
?>
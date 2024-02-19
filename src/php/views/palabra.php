<div id="tabla-container">
  <table>
    <thead>
      <tr>
      <?php
if ($retornado == null) {
  // Código cuando $retornado es null
} else {
  foreach ($retornado as $dato) {
    $nombreClase = $dato['nombreClase'];
  }
?>
  <th><?php echo $nombreClase ?></th>
<?php
}
?>

       
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if ($retornado  == null){
        echo '<tr><td>No hay palabras registradas</td></tr>';
      }
      else{
        foreach ($retornado as $elemento) {
          echo '<tr>';
          echo '<td>' . $elemento['palabra'] . '</td>';
          echo '<td class="actions">';
          echo '<div class="actions-container">';
          echo '<a class="edit" href="index.php?action=obtenerPalabra&controller=palabra&idClase=&idPalabra='.$elemento['idPalabra'].'">Editar</a>';
          echo '<a class="delete" href="index.php?action=eliminarPalabra&controller=palabra&idPalabra='.$elemento['idPalabra'].'">Borrar</a>';
          echo '<a class="edit" href="index.php?action=listarTraduccion&controller=traduccion&idPalabra='.$elemento['idPalabra'].'">Traducciones</a>';
          if (!empty($elemento['audio'])) {
              echo '<audio id="miAudio" controls>';
              echo '<source src="data:audio/mpeg;base64,' . $elemento['audio'] . '" type="audio/mpeg">';
              echo '</audio>';
          }
          echo '</div>'; 
          echo '</td>';
          echo '</tr>';
        }
      }
    ?>
    </tbody>
  </table>
</div>
<div  id='aniadirclase'>
  <a href='index.php?action=aniadirPalabra&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>'>Agregar palabras</a>
</div>
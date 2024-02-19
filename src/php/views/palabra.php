<div id="tabla-container">
  <table>
    <thead>
      <tr>
        <th><?php echo $_GET['nombreClase']?></th>
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
          echo '<a class="edit" href="index.php?action=editarPalabra&controller=palabra&idClase='.$_GET['idClase'].'&nombreClase='.$_GET['nombreClase'].'&idPalabra='.$elemento['idPalabra'].'&palabra='.$elemento['palabra'].'">Editar</a>';
          echo '<a class="delete" href="index.php?action=eliminarPalabra&controller=palabra&idClase='.$_GET['idClase'].'&nombreClase='.$_GET['nombreClase'].'&idPalabra='.$elemento['idPalabra'].'">Borrar</a>';
          echo '<a class="edit" href="index.php?action=listarTraduccion&controller=traduccion&idPalabra='.$elemento['idPalabra'].'&palabra='.$elemento['palabra'].'">Traducciones</a>';
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
  <a href='index.php?action=aniadirPalabra&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>&nombreClase=<?php echo $_GET['nombreClase']?>'>Agregar palabras</a>
</div>

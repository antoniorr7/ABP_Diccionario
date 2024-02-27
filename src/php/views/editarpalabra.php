<div class="popup">
<form id="traductor-form" method="post" action="index.php?action=editarPalabra&controller=palabra&idPalabra=<?php echo $_GET['idPalabra']; ?>" enctype="multipart/form-data">
  <?php foreach ($retornado as $index => $data): ?>
    <?php if ($index === 0): ?>
      <input type="hidden" name="idPalabra" value="<?php echo $data['idPalabra']; ?>">
      <div class="input-container">
        <label for="palabra">Palabra:</label>
        <input type="text" id="palabra" name="palabra" value="<?php echo $data['palabra']; ?>">
      </div>
      <label for="audio">Archivo de Audio:</label>
      <?php
        if(isset($data['audio']) && !empty($data['audio'])) {
          $audio_decoded = base64_decode($data['audio']);
          $audio_data_uri = 'data:audio/mpeg;base64,' . base64_encode($audio_decoded);
          echo '<div class=audio-container>';
          echo '<audio controls style="width: 100%;">

                  <source src="' . $audio_data_uri . '" type="audio/mpeg">
                </audio>
                </div>';
               
      } 
      echo '    <input type="file" id="audio" name="audio" accept="audio/*" >';
      ?>
      
      <label for="traduccion">Traducciónes:</label>
    <?php endif; ?>
   
    <div class="input-container" id="traducciones-container">
    <input type="hidden" name="idTraduccion[]" value="<?php echo $data['idTraduccion']; ?>">
   
      <input type="text" id="traduccion" name="traduccion[]" value="<?php echo $data['significados']; ?>">
      <a href="index.php?action=eliminarTraduccion&controller=palabra&idTraduccion=<?php echo $data['idTraduccion']; ?>&idPalabra=<?php echo $data['idPalabra']; ?>">eliminar</a>
    </div>
  <?php endforeach; ?>
  <input type="submit" id="editar" value="Traducir">
  <a href="index.php?action=aniadirTraduccion&controller=palabra&idPalabra=<?php echo $_GET['idPalabra']; ?>">añadir Traduccion</a>
</form>
<a  href="index.php?action=listarClases&controller=clase"><img id='atras' src="../img/flecha-izquierda.png" alt=""></a>

</div>

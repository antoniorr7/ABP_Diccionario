<div class="popup">
  <h2>Introduce el Nombre de la palabra</h2>
  <form action="index.php?action=editarPalabra&controller=palabra" method="post" enctype="multipart/form-data">

    <input type="hidden" name="idPalabra" value="<?php echo ($_GET['idPalabra']); ?>">
    
    <input type="hidden" name="idClase" value="<?php echo ($retornado)['idClase']; ?>">
    <label for="nombrePalabra">Nombre de la palabra:</label>
    
    <input type="text" id="nombrePalabra" name="palabra" required value='<?php echo $retornado['palabra'];?>' >
    <!-- <br>
    <label for="audioFile">Selecciona un archivo de audio:</label>
    <input type="file" id="audioFile" name="audio" accept="audio/*" required value='<8?php echo $_GET['audio'];?>' >
    <br> -->
    <input type="submit" value="Enviar" class="btn">
  </form>

  <a href="index.php"><img src="" alt="atras"></a>
</div>

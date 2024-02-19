<div class="popup">
  <h2>Introduce el Nombre de la palabra</h2>
  <form action="index.php?action=aniadirPalabra&controller=palabra" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idClase" value="<?php echo ($_GET['idClase']); ?>">

    <label for="nombrePalabra">Nombre de la palabra:</label>
    <input type="text" id="nombrePalabra" name="palabra" required>
    <br>
    <!-- Aquí se añade el campo de tipo archivo para el audio -->
    <label for="audioFile">Selecciona un archivo de audio:</label>
    <input type="file" id="audioFile" name="audio" accept="audio/*" >
    <br>
    <input type="submit" value="Enviar" class="btn">
  </form>

  <a href="index.php"><img src="" alt="atras"></a>
</div>

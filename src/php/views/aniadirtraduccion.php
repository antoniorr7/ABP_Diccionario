<div class="popup">
  <h2>Introduce la traduccion</h2>
  
  <form action="index.php?action=aniadirTraduccion&controller=traduccion" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idPalabra" value="<?php echo ($_GET['idPalabra']); ?>">
    <input type="hidden" name="palabra" value="<?php echo ($_GET['palabra']); ?>">
    <label for="traduccion">Significado:</label>
    <input type="text" id="nombrePalabra" name="traduccion" required>
    <br>

    <input type="submit" value="Enviar" class="btn">
  </form>

  <a href="index.php"><img src="" alt="atras"></a>
</div>

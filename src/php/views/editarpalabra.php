<form id="traductor-form" method="post" action="index.php?action=editarPalabra&controller=palabra&idPalabra=<?php echo $_GET['idPalabra']; ?>">
  <?php foreach ($retornado as $index => $data): ?>
    <?php if ($index === 0): ?>
      <input type="hidden" name="idPalabra" value="<?php echo $data['idPalabra']; ?>">
      <div class="input-container">
        <label for="palabra">Palabra:</label>
        <input type="text" id="palabra" name="palabra" value="<?php echo $data['palabra']; ?>">
      </div>
    <?php endif; ?>
    <div class="input-container" id="traducciones-container">
    <input type="hidden" name="idTraduccion[]" value="<?php echo $data['idTraduccion']; ?>">
      <label for="traduccion">Traducción:</label>
      <input type="text" id="traduccion" name="traduccion[]" value="<?php echo $data['significados']; ?>">
    </div>
  <?php endforeach; ?>
  <input type="submit" id="editar" value="Traducir">
</form>



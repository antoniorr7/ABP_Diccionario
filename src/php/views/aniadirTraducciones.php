<form id="formularioTraducciones" class="formulario" action="index.php?action=guardarPalabra&controller=palabra" method="POST">
   <h1><?php echo $_POST['palabra']?></h1><br>
    <?php
    $numTraducciones = $_POST['numTraducciones'];
    for ($i = 1; $i <= $numTraducciones; $i++) {
        echo '<label for="traduccion'.$i.'">Traducción '.$i.':</label>';
        echo '<input type="text" id="traduccion" name="traduccion'.$i.'" class="campoTexto" required>';
    }
    ?>
    <input type="hidden" name="palabra" value="<?php echo $_POST['palabra']?>">
    <input type="hidden" id="idClase" name="idClase" value=<?php  echo $_POST['idClase']; ?> >
    <input type="hidden" name="numTraducciones" value="<?php echo $_POST['numTraducciones']?>">
    <input type="submit" id="btnGuardarTraducciones" value="Guardar Traducciones">
</form>

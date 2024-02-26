<form id="formularioTraducciones" enctype="multipart/form-data" class="formulario" action="index.php?action=guardarPalabra&controller=palabra" method="POST">
   <h1><?php echo $_POST['palabra']?></h1><br>  
    <label for="audio">Archivo de Audio:</label>
    <input type="file" id="audio" name="audio" accept="audio/*">
    <?php
    
    $numTraducciones = $_POST['numTraducciones'];
    echo '<label for="traduccion">Traducciónes :</label>';
    for ($i = 1; $i <= $numTraducciones; $i++) {
      
        echo '<input type="text" id="traduccion" name="traduccion'.$i.'" class="campoTexto" style="border: 2px solid #ccc; border-radius: 5px; padding: 5px;" required>';

    }
    ?>
  
    <input type="hidden" name="palabra" value="<?php echo $_POST['palabra']?>">
    <input type="hidden" id="idClase" name="idClase" value=<?php  echo $_POST['idClase']; ?> >
    <input type="hidden" name="numTraducciones" value="<?php echo $_POST['numTraducciones']?>">
    <input type="submit" id="btnGuardarTraducciones" value="Guardar Traducciones">
</form>
<?php    print("<pre>".print_r($_POST,true)."</pre>"); 
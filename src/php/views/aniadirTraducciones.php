<div class="popup">
<form id="formularioTraducciones" enctype="multipart/form-data" class="formulario" action="index.php?action=guardarPalabra&controller=palabra" method="POST">
   <h1><?php echo $_POST['palabra']?></h1><br>  
    <label for="audio">Archivo de Audio:</label>
    <input type="file" id="audio" name="audio" accept="audio/*">
    <?php
    
    $numTraducciones = $_POST['numTraducciones'];
    
    // Verificar si $numTraducciones es distinto de un número y mostrar un error
    if (!is_numeric($numTraducciones)) {
        echo '<p style="color: red;">Error: El número de traducciones no es válido.</p>';
        $numTraducciones = 0; 
    } else {
        echo '<label for="traduccion">Traducciones :</label>';
        for ($i = 1; $i <= $numTraducciones; $i++) {
            echo '<input type="text" id="traduccion" name="traduccion'.$i.'" class="campoTexto" style="border: 2px solid #ccc; border-radius: 5px; padding: 5px;" required>';
        }
    }
    ?>

    <input type="hidden" name="palabra" value="<?php echo $_POST['palabra']?>">
    <input type="hidden" id="idClase" name="idClase" value=<?php  echo $_POST['idClase']; ?> >
    <input type="hidden" name="numTraducciones" value="<?php echo $numTraducciones ?>">
    <input type="submit" id="btnGuardarTraducciones" value="Guardar ">
</form>
<a  href="index.php?action=listarClases&controller=clase"><img id='atras' src="../img/flecha-izquierda.png" alt=""></a>
</div>
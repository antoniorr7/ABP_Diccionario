<div class="popup">
<form id="formularioPalabra" class="formulario" action="index.php?action=aniadirTraducciones&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="idClase" name="idClase" value="<?php echo $_GET['idClase']; ?>">
    <label for="palabra">Palabra:</label>
    <input type="text" id="palabra" name="palabra" class="campoTexto" >
    <label for="numTraducciones">Número de Traducciones:</label>
    <input  id="numTraducciones" name="numTraducciones" class="campoNumero" min="1" >
    <input type="submit" id="btnAñadirPalabra" value="Añadir Palabra">
    <input type="reset" value="Limpiar">

    <?php   
    if (isset($retornado)) {
        echo '<p style="color: red;">'.$retornado.'</p>'; }
    ?>
</form>
<a  href="index.php?action=listarPalabras&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>"><img id='atras' src="../img/flecha-izquierda.png" alt=""></a>
</div>
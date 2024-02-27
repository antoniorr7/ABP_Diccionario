<div class="popup">
<form id="formularioPalabra" class="formulario" action="index.php?action=aniadirTraducciones&controller=palabra" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="idClase" name="idClase" value="<?php echo $_GET['idClase']; ?>">
    <label for="palabra">Palabra:</label>
    <input type="text" id="palabra" name="palabra" class="campoTexto" required>
    <label for="numTraducciones">Número de Traducciones:</label>
    <input type="number" id="numTraducciones" name="numTraducciones" class="campoNumero" min="1" required>
    <input type="submit" id="btnAñadirPalabra" value="Añadir Palabra">
</form>
<a  href="index.php?action=listarPalabras&controller=palabra&idClase=<?php echo $_GET['idClase']; ?>"><img id='atras' src="../img/flecha-izquierda.png" alt=""></a>
</div>
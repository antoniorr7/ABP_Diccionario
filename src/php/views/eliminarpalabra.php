
<div id="confirmacionBorrado">
<form id="confirmacionForm" action="index.php?action=eliminarpalabra&controller=palabra&idPalabra=<?php echo $_GET['idPalabra']; ?>" method="POST">
        <p>¿Estás seguro de que deseas borrar esta palabra?</p>
        <label for="confirmarSi">Sí</label>
        <input type="radio" id="confirmarSi" name="confirmarBorrado" value="si">
        <label for="confirmarNo">No</label>
        <input type="radio" id="confirmarNo" name="confirmarBorrado" value="no">
        <input type="submit">
       </form>
</div>


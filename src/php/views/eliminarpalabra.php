
<div id="confirmacionBorrado">
<form id="confirmacionForm" action="index.php?action=eliminarpalabra&controller=palabra&idPalabra=<?php echo $_GET['idPalabra']; ?>" method="POST">
        <p>¿Estás seguro de que deseas borrar esta palabra?</p>
        <input type="hidden" id="confirmarSi" name="confirmarBorrado" value="si"> 
        <input type="submit" value= Eliminar>
       </form>
          <a  href="index.php?action=listarClases&controller=clase"><img id='atras' src="../img/flecha-izquierda.png" alt=""></a>
</div>


<div class="popup">
  <h2>Introduce el Nombre de la Clase</h2>
  <form action="index.php?action=aniadirClases&controller=clase" method="post">
    <input type="hidden" value='<?php echo $_GET['idClase']; ?>'>
    <label for="nombreClase">Nombre de la Clase:</label>
    <input type="text" id="nombreClase" name="nombreClase" >
    <label for="codigo">Codigo de la Clase</label>
    <input type="text" id=codigo name=codigo>
    <br>
    <input type="submit" value="Enviar" class="btn">
  </form>
    <a  href="index.php?action=listarClases&controller=clase"><img id='atras' src="../img/flecha-izquierda.png" alt=""></a>
</div>
<div class="popup">
  <h2>Introduce el Nombre de la Clase</h2>
  <form action="index.php?action=editarClases&controller=clase" method="post">
   <input type="hidden" name="id" value='<?php echo $_GET['id']; ?>'>
    <label for="nombreClase">Nombre de la Clase:</label>
    <input type="text" id="nombreClase" name="nombreClase" value='<?php echo $_GET['nombreClase']; ?>' required>
    <br>
    <input type="submit" value="Enviar" class="btn">
  </form>
    <a href="index.php?action=listarClases&controller=clase"><img src="" alt="atras"></a>
</div>
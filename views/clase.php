 <div class="container">
    <div id="tabla-container">
      <table class="table">
        <thead>
          <tr>
            <th>Nombre de la Clase</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php
          if ($retornado == null) {
            echo '<tr><td>No hay clases registradas</td></tr>';
          } else {
            foreach ($retornado as $elemento) {
              echo '<tr>';
              echo '<td>' . $elemento['nombreClase'] . '</td>';
              echo '<td class="actions">';
              // echo '<a class="edit" href="index.php?action=obtenerEditar&controller=clase&id=' . $elemento['id'] .'">Editar</a>';
              // echo '<a class="delete" href="index.php?action=eliminarClase&controller=clase&id=' . $elemento['id'] . '">Borrar</a>';
              echo '<a class="edit btn btn-primary" href="index.php?action=listarPalabras&controller=palabra&idClase=' . $elemento['id'] .'">Diccionario</a>';
              echo '</td>';
              echo '</tr>';
            }
          }
        ?>
        </tbody>
      </table>
    </div>
    <!-- <div  id='aniadirclase'>
      <a href='index.php?action=formularioClase&controller=clase' class="btn btn-success">Agregar Clase</a>
    </div> -->
  </div>
</body>
</html>

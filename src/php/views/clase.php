<div id="tabla-container">
  <table>
    <thead>
      <tr>
        <th>Nombre de la Clase</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if ($retornado  == null){
        echo '<tr><td>No hay clases registradas</td></tr>';
      }
      else{
        foreach ($retornado as $elemento) {
          echo '<tr>';
          echo '<td>' . $elemento['nombreClase'] . '</td>';
          echo '<td class="actions">';
          echo '<a class="edit" href="index.php?action=editarClases&controller=clase&id=' . $elemento['id'] .'&nombreClase='. $elemento['nombreClase'] . '">Editar</a>';
          echo '<a class="delete" href="index.php?action=eliminarClase&controller=clase&id=' . $elemento['id'] . '">Borrar</a>';
          echo '<a class="edit" href="index.php?action=listarPalabras&controller=palabra&idClase=' . $elemento['id'] .'&nombreClase=' .$elemento['nombreClase'] . '">palabra</a>';

          echo '</td>';
          

              echo '</td>';
          echo '</tr>';
        }
      }
    ?>
    </tbody>
  </table>

</div>
<div  id='aniadirclase'>
  <a href='index.php?action=aniadirClases&controller=clase'>Agregar Clase</a>
</div>
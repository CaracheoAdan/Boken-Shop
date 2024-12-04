<?php require('views/header/headerAdministrador.php');?>
  <h1>Prendas</h1>
  <?php if (isset($mensaje)): $app -> alerta($tipo, $mensaje); endif;?>
  <a href="prenda.php?accion=crear" class="btn btn-success">Nuevo</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id prenda</th>
      <th scope="col">Prenda</th>
      <th scope="col">Descripcion</th>
      <th scope="col">precio</th>
      <th scope="col">Categoria</th>
      <th scope="col">fecha_registro</th>
  </thead>
  <tbody>
    <?php foreach($prendas as $prenda): ?>
    <tr>
      <th scope="row"><?php echo $prenda ['id_prenda']; ?></th>
      <td><?php echo $prenda ['nombre']; ?></td>
      <td><?php echo $prenda ['descripcion']; ?></td>
      <td><?php echo $prenda ['precio']; ?></td>
      <td><?php echo $prenda ['id_categoria']; ?></td>
      <td><?php echo $prenda ['fecha_registro']; ?></td>

      <td>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <a href="prenda.php?accion=actualizar&id=<?php echo $prenda ['id_prenda']; ?>" class="btn btn-warning">Actualizar</a>
          <a href="prenda.php?accion=eliminar&id=<?php echo $prenda ['id_prenda']; ?>" class="btn btn-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require('views/footer.php')?>
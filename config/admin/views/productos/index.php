<?php require('views/header/headerAdministrador.php');?>
  <h1>productos</h1>


  <?php if (isset($mensaje)): $app -> alerta($tipo, $mensaje); endif;?>
  <a href="producto.php?accion=crear" class="btn btn-success">Nuevo</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id </th>
      <th scope="col">producto</th>
      <th scope="col">Descripcion</th>
      <th scope="col">precio</th>
      <th scope="col">descuento</th>
      <th scope="col">id_categoria</th>
      <th scope="col">activo</th>
  </thead>
  <tbody>
    <?php foreach($productos as $producto): ?>
    <tr>
      <th scope="row"><?php echo $producto ['id']; ?></th>
      <td><?php echo $producto ['nombre']; ?></td>
      <td><?php echo $producto ['descripcion']; ?></td>
      <td><?php echo $producto ['precio']; ?></td>
      <td><?php echo $producto ['descuento']; ?></td>
      <td><?php echo $producto ['id_categoria']; ?></td>
      <td><?php echo $producto ['activo']; ?></td>


      <td>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <a href="producto.php?accion=actualizar&id=<?php echo $producto ['id']; ?>" class="btn btn-warning">Actualizar</a>
          <a href="producto.php?accion=eliminar&id=<?php echo $producto ['id']; ?>" class="btn btn-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require('views/footer.php')?>
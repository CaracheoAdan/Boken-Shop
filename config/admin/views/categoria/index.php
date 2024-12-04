<?php require('views/header/headerAdministrador.php');?>
  <h1>categorias</h1>
  <?php if (isset($mensaje)): $app -> alerta($tipo, $mensaje); endif;?>
  <a href="categoria.php?accion=crear" class="btn btn-success">Nuevo</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id categoria</th>
      <th scope="col">Categoria</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($categorias as $categoria): ?>
    <tr>
      <th scope="row"><?php echo $categoria ['id_categoria']; ?></th>
      <td><?php echo $categoria ['categoria']; ?></td>
      <td> 
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <a href="categoria.php?accion=actualizar&id=<?php echo $categoria ['id_categoria']; ?>" class="btn btn-warning">Actualizar</a>
          <a href="categoria.php?accion=eliminar&id=<?php echo $categoria ['id_categoria']; ?>" class="btn btn-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require('views/footer.php')?>
<?php require('views/header/headerAdministrador.php');?>
  <h1>Permisos</h1>
  <?php if (isset($mensaje)): $app -> alerta($tipo, $mensaje); endif;?>
  <a href="permiso.php?accion=crear" class="btn btn-success">Nuevo</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id permiso</th>
      <th scope="col">Permiso</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($permisos as $permiso): ?>
    <tr>
      <th scope="row"><?php echo $permiso ['id_permiso']; ?></th>
      <td><?php echo $permiso ['permiso']; ?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <a href="permiso.php?accion=actualizar&id=<?php echo $permiso ['id_permiso']; ?>" class="btn btn-warning">Actualizar</a>
          <a href="permiso.php?accion=eliminar&id=<?php echo $permiso ['id_permiso']; ?>" class="btn btn-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require('views/footer.php')?>

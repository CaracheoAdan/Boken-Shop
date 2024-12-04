<?php require('views/header/headerAdministrador.php');?>
  <h1>empleados</h1>
  <?php if (isset($mensaje)): $app -> alerta($tipo, $mensaje); endif;?>
  <a href="empleado.php?accion=crear" class="btn btn-success">Nuevo</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id empleado</th>
      <th scope="col">Fotografia</th>
      <th scope="col">Primer apellido</th>
      <th scope="col">Segundo apellido</th>
      <th scope="col">Nombre</th>
      <th scope="col">RFC</th>
      <th scope="col">Correo</th>
      <th scope="col">Opciones</th>
  </thead>
  <tbody>
    <?php foreach($empleados as $empleado): ?>
    <tr>
      <th scope="row"><?php echo $empleado['id_empleado']; ?></th>
      <td><img src="<?php 
        if(file_exists("../uploads/".$empleado['fotografia'])) {
          echo("../uploads/".$empleado['fotografia']);
        } else {
          echo("../uploads/default.png");
        }
      ?>" class="rounded-circle" height="100" width="100"></td>
      <td><?php echo $empleado ['primer_apellido']; ?></td>
      <td><?php echo $empleado ['segundo_apellido']; ?></td>
      <td><?php echo $empleado ['nombre']; ?></td>
      <td><?php echo $empleado ['rfc']; ?></td>
      <td><?php echo $empleado ['correo']; ?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <a href="empleado.php?accion=actualizar&id=<?php echo $empleado ['id_empleado']; ?>" class="btn btn-warning">Actualizar</a>
          <a href="empleado.php?accion=eliminar&id=<?php echo $empleado ['id_empleado']; ?>" class="btn btn-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require('views/footer.php')?>
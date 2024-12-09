<?php require('views/header/headerAdministrador.php');?>
    <h1>Empleados</h1>
    <?php if (isset($mensaje)): $app -> alerta($tipo, $mensaje); endif;?>
    <a href="empleado.php?accion=crear" class="btn btn-success">Nuevo Empleado</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Empleado</th>
                <th scope="col">Fotografía</th>
                <th scope="col">Primer Apellido</th>
                <th scope="col">Segundo Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">RFC</th>
                <th scope="col">Correo</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
            <tr>
                <th scope="row"><?php echo $empleado['id_empleado']; ?></th>
                <td><img class="rounded-circle w-25" src=" <?php 
                    if(file_exists("../uploads/".$empleado['fotografia'])){
                        echo("../uploads/".$empleado['fotografia']);
                    } else {
                        echo('../uploads/default.png');
                    }
                ?>"></td>
                <td><?php echo $empleado['primer_apellido']; ?></td>
                <td><?php echo $empleado['segundo_apellido']; ?></td>
                <td><?php echo $empleado['nombre']; ?></td>
                <td><?php echo $empleado['rfc']; ?></td>
                <td><?php echo $empleado['correo']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <a href="empleado.php?accion=actualizar&id=<?php echo $empleado['id_empleado']; ?>" class="btn btn-warning">Actualizar</a>
                        <a href="empleado.php?accion=eliminar&id=<?php echo $empleado['id_empleado']; ?>" class="btn btn-danger">Eliminar</a>                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php require('views/footer.php'); ?>


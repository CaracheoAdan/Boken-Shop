<?php require('views/header/headerAdministrador.php');?>
<h1><?php echo ($accion == "crear") ? "Nuevo " : "Modificar "; ?>Empleado</h1>

<form action="empleado.php?accion=<?php echo ($accion == "crear") ? 'nuevo' : 'modificar&id=' . $id; ?>" method="post" enctype="multipart/form-data" >
    <div class="row mb-3">
        <label for="primer_apellido" class="col-sm-2 col-form-label">Primer Apellido</label>
        <div class="col-sm-10">
            <input type="text" name="data[primer_apellido]" class="form-control" placeholder="Primer apellido"
                   value="<?php echo isset($empleado['primer_apellido']) ? $empleado['primer_apellido'] : ''; ?>" required/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="segundo_apellido" class="col-sm-2 col-form-label">Segundo Apellido</label>
        <div class="col-sm-10">
            <input type="text" name="data[segundo_apellido]" class="form-control" placeholder="Segundo apellido"
                   value="<?php echo isset($empleado['segundo_apellido']) ? $empleado['segundo_apellido'] : ''; ?>"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" name="data[nombre]" class="form-control" placeholder="Nombre"
                   value="<?php echo isset($empleado['nombre']) ? $empleado['nombre'] : ''; ?>" required/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="rfc" class="col-sm-2 col-form-label">RFC</label>
        <div class="col-sm-10">
            <input type="text" name="data[rfc]" class="form-control" placeholder="RFC"
                   value="<?php echo isset($empleado['rfc']) ? $empleado['rfc'] : ''; ?>" required/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="correo" class="col-sm-2 col-form-label">Correo</label>
        <div class="col-sm-10">
            <select name="data[id_usuario]" class="form-select" required>
                <option value="">Seleccione un correo</option>
                <?php
                $usuarios = $app->getUsuarios(); 
                foreach ($usuarios as $usuario):
                    $selected = (isset($empleado['id_usuario']) && $empleado['id_usuario'] == $usuario['id_usuario']) ? 'selected' : '';
                ?>
                    <option value="<?php echo $usuario['id_usuario']; ?>" <?php echo $selected; ?>>
                        <?php echo $usuario['correo']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="fotografia" class="col-sm-2 col-form-label">fotografia</label>
        <div class="col-sm-10">
            <input type="file" name="fotografia" class="form-control" placeholder="Coloca la fotografia" />       
        </div>
    </div>
    <input type="submit" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php'); ?>



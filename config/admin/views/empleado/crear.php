<?php require('views/header/headerAdministrador.php'); ?>
<center>
    <h1><?php if($accion=="crear"):echo('Nuevo');else: echo ('Modificar');endif; ?> empleado</h1>
</center>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="post" enctype="multipart/form-data" action="empleado.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif;?>">

        <div class="mb-3">
            <label for="primer_apellido" class="form-label">Primer apellido</label>
            <input class="form-control" type="text" name="data[primer_apellido]" placeholder="Escribe aquí el primer apellido" value="<?php if(isset($empleados["primer_apellido"])):echo($empleados['primer_apellido']);endif;?>" id="primer_apellido"/>
        </div>

        <div class="mb-3">
            <label for="segundo_apellido" class="form-label">Segundo apellido</label>
            <input class="form-control" type="text" name="data[segundo_apellido]" placeholder="Escribe aquí el segundo apellido" value="<?php if(isset($empleados["segundo_apellido"])):echo($empleados['segundo_apellido']);endif;?>" id="segundo_apellido"/>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input class="form-control" type="text" name="data[nombre]" placeholder="Escribe aquí el nombre" value="<?php if(isset($empleados["nombre"])):echo($empleados['nombre']);endif;?>" id="nombre"/>
        </div>

        <div class="mb-3">
            <label for="rfc" class="form-label">RFC</label>
            <input class="form-control" type="text" name="data[rfc]" placeholder="Escribe aquí el RFC" value="<?php if(isset($empleados["rfc"])):echo($empleados['rfc']);endif;?>" id="rfc"/>
        </div>

        <div class="mb-3">
           <label for="">Id del usuario</label> 
           <select name="data[id_usuario]" id="" class="form-select">
                <?php foreach($usuarios as $usuario):?> 
                <?php
                    $selected = "";
                    if ($empleados['correo'] == $usuario['correo']) {
                        $selected = "selected";
                    }
                ?>
                <option value="<?php echo($usuario['id_usuario']);?>" <?php echo($selected);?>> <?php echo($usuario['correo']);?> </option>
                <?php endforeach;?>
           </select>
        </div>

        <div class="mb-3">
            <label for="fotografia" class="form-label">Fotografía</label>
            <input class="form-control" type="file" name="fotografia" placeholder="Selecciona la fotografía" id="fotografia"/>
        </div>

        <input type="submit" value="Guardar" name="data[enviar]" class="btn btn-primary w-100">
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<?php require('views/footer.php'); ?>
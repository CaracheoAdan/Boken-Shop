<?php require('views/header/headerAdministrador.php'); ?>
    <h1><?php if($accion=="crear"):echo('Nuevo');else: echo ('Modificar');endif; ?> usuario</h1>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="post" action="usuario.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif;?>">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input class="form-control" type="text" name="data[correo]" placeholder="Escribe aquí el correo electrónico" value="<?php if(isset($usuario["correo"])):echo($usuario['correo']);endif;?>" id="correo"/>
        </div>

        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input class="form-control" id="contrasena" type="password" name="data[contrasena]" placeholder="Escribe aquí la contraseña" value="<?php if(isset($usuario["contrasena"])):echo($usuario['contrasena']);endif;?>"/>
        </div>

        <?php foreach($roles as $rol): ?>
          <div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" <?php $checked = ''; if(in_array($rol['id_rol'], $misRoles)): $checked = 'checked'; endif; echo($checked); ?> role="switch" id="flexSwitchCheckChecked" name="rol[<?php echo($rol['id_rol']);?>]">
              <label class="form-check-label" for="flexSwitchCheckChecked"><?php echo($rol['rol']);?></label>
            </div>
          </div>
        <?php endforeach;?>

        <input type="submit" value="Guardar" name="data[enviar]" class="btn btn-primary w-100">
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<?php require('views/footer.php'); ?>
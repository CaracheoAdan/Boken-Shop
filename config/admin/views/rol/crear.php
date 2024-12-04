<?php require('views/header/headerAdministrador.php'); ?>
<center>
    <h1><?php if($accion=="crear"):echo('Nuevo');else: echo ('Modificar');endif; ?> rol</h1>
</center>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="post" action="rol.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif;?>">
        <div class="mb-3">
            <label for="rol" class="form-label">Nombre del rol</label>
            <input class="form-control" type="text" name="data[rol]" placeholder="Escribe aquí el nombre" value="<?php if(isset($roles["rol"])):echo($roles['rol']);endif;?>" id="rol"/>
        </div>

        <input type="submit" value="Guardar" name="data[enviar]" class="btn btn-primary w-100">
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<?php require('views/footer.php'); ?>

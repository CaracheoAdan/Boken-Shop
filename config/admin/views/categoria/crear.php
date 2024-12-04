<?php require('views/header/headerAdministrador.php');?>

    <h1><?php if($accion=="crear"):echo('Nuevo');else: echo ('Modificar');endif; ?> categoria</h1>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="post" action="categoria.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif;?>">
        <div class="mb-3">
            <label for="categoria" class="form-label">Nombre del categoria</label>
            <input class="form-control" type="text" name="data[categoria]" placeholder="Escribe aqui el nombre" value="<?php if(isset($categorias["categoria"])):echo($categorias['categoria']);endif;?>" id="categoria"/>
        </div>

        <input type="submit" value="Guardar" name="data[enviar]" class="btn btn-primary w-100">
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<?php require('views/footer.php'); ?>
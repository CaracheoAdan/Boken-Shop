<?php require('views/header/headerAdministrador.php'); ?>
<h1><?php if($accion=="crear"):echo('nuevo');else: echo ('Modificar');endif; ?> Prenda</h1>

    <?php ?>
<form method="post" action="prenda.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif;?>">
    <div class="mb-3">
        <label for="prenda" class="form-label">Nombre de la prenda</label>
        <input class="form-control" type="text" name="data[nombre]" placeholder="Escribe aqui el nombre" value="<?php if(isset($prendas["nombre"])):echo($prendas['nombre']);endif;?>" id="nombre"/>
    </div>

    <div class="mb-3">
        <label for="area" class="form-label">Descripcion de la prenda</label>
        <input class="form-control" type="text" name="data[descripcion]" placeholder="Escribe aqui la descripcion" value="<?php if(isset($prendas["descripcion"])):echo($prendas['descripcion']);endif;?>"/>
        </div>

    <div class="mb-3">
        <label for="id_prenda" class="form-label">Precio</label>
        <input class="form-control" type="number" name="data[precio]" placeholder="Escribe precio" value="<?php if(isset($prendas["precio"])):echo($prendas['precio']);endif;?>"/>
    </div>

    <div class="mb-3">
            <label class="form-label" for="fecha">Fecha</label>
            <input class="form-control" type="date" name="data[fecha_registro]" placeholder="Escribe aqui la fecha" value="<?php if(isset($prendas["fecha_registro"])):echo($prendas['fecha_registro']);endif;?>"/>
     </div>

   <div class="md-3">
        <label for="">Categoria</label>
        <select name="data[id_categoria]">
            <?php foreach($prendas as $prenda): ?>
                
                <option value="<?php echo($prenda['id_categoria']); ?>"><?php echo($prenda['categoria']); ?></option>
             <?php endforeach ?>
        </select>
   </div> 

    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?>
<?php require('views/header.php'); ?>

<h1><?php echo ($accion == 'crear') ? 'Nuevo Producto' : 'Actualizar Producto'; ?></h1>

<form method="post" action="producto.php?accion=<?php echo ($accion == 'crear') ? 'nuevo' : 'modificar&id=' . $id; ?>">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="data[nombre]" id="nombre" 
               value="<?php echo isset($producto['nombre']) ? $producto['nombre'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" name="data[descripcion]" id="descripcion" 
               value="<?php echo isset($producto['descripcion']) ? $producto['descripcion'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" name="data[precio]" id="precio" 
               step="0.01" value="<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?>" required>
    </div>

    <div class="mb-3">
        <label for="descuento" class="form-label">Descuento</label>
        <input type="number" class="form-control" name="data[descuento]" id="descuento" 
               value="<?php echo isset($producto['descuento']) ? $producto['descuento'] : ''; ?>">
    </div>

    <div class="mb-3">
        <label for="id_categoria" class="form-label">Categoría</label>
        <select class="form-select" name="data[id_categoria]" id="id_categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id_categoria']; ?>" 
                        <?php echo (isset($producto['id_categoria']) && $producto['id_categoria'] == $categoria['id_categoria']) ? 'selected' : ''; ?>>
                    <?php echo $categoria['categoria']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="activo" class="form-label">Activo</label>
        <select class="form-select" name="data[activo]" id="activo" required>
            <option value="1" <?php echo (isset($producto['activo']) && $producto['activo'] == 1) ? 'selected' : ''; ?>>Sí</option>
            <option value="0" <?php echo (isset($producto['activo']) && $producto['activo'] == 0) ? 'selected' : ''; ?>>No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?php require('views/footer.php'); ?>

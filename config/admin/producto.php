<?php
require_once('producto.class.php');
require_once('categoria.class.php');

$appCategoria = new categoria();
$app = new productos();
$app->checkRole('Administrador');

$accion = isset($_GET['accion']) ? $_GET['accion'] : NULL;
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear': {
        $categorias = $appCategoria->readAll(); // Usar $categorias para datos de categorías
        include 'views/productos/crear.php';
        break;
    }

    case 'nuevo': {
        $data = isset($_POST['data']) ? $_POST['data'] : [];
        $resultado = $app->create($data);

        if ($resultado) {
            $mensaje = "Producto dado de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "El producto no se pudo dar de alta";
            $tipo = "danger";
        }

        $productos = $app->readAll();
        include('views/productos/index.php');
        break;
    }

    case 'actualizar': {
        $producto = $app->readOne($id); // Producto específico
        $categorias = $appCategoria->readAll(); // Todas las categorías
        include('views/productos/crear.php');
        break;
    }

    case 'modificar': {
        $data = isset($_POST['data']) ? $_POST['data'] : [];
        $result = $app->update($id, $data);

        if ($result) {
            $mensaje = "El producto se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "El producto no se pudo actualizar";
            $tipo = "danger";
        }

        $productos = $app->readAll();
        include('views/productos/index.php');
        break;
    }

    case 'eliminar': {
        if (!is_null($id) && is_numeric($id)) {
            $resultado = $app->delete($id);

            if ($resultado) {
                $mensaje = "El producto se eliminó correctamente";
                $tipo = "success";
            } else {
                $mensaje = "El producto no se pudo eliminar";
                $tipo = "danger";
            }
        }

        $productos = $app->readAll();
        include('views/productos/index.php');
        break;
    }

    default: {
        $productos = $app->readAll();
        include 'views/productos/index.php';
        break;
    }
}
?>

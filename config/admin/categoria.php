<?php
require_once('categoria.class.php'); // Incluye la clase categoría

$app = new categoria(); // Instancia de la clase categoría
$app->checkRole('Administrador'); // Verifica el rol de administrador

$accion = isset($_GET['accion']) ? $_GET['accion'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear': {
        $categorias = $app->readAll(); // Obtiene todas las categorías
        include 'views/categoria/crear.php'; // Carga la vista de creación
        break;
    }

    case 'nuevo': {
        $data = $_POST['data'];
        $resultado = $app->create($data); // Crea una nueva categoría

        if ($resultado) {
            $mensaje = "Categoría dada de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "La categoría no ha sido dada de alta";
            $tipo = "danger";
        }

        $categorias = $app->readAll(); // Actualiza la lista de categorías
        include('views/categoria/index.php'); // Carga la vista del índice
        break;
    }

    case 'actualizar': {
        $categoria = $app->readOne($id); // Obtiene la categoría a actualizar
        $categorias = $app->readAll(); // Obtiene todas las categorías
        include('views/categoria/crear.php'); // Carga la vista de actualización
        break;
    }

    case 'modificar': {
        $data = $_POST['data'];
        $resultado = $app->update($id, $data); // Actualiza la categoría

        if ($resultado) {
            $mensaje = "La categoría se ha actualizado";
            $tipo = "success";
        } else {
            $mensaje = "No se ha actualizado la categoría";
            $tipo = "danger";
        }

        $categorias = $app->readAll(); // Actualiza la lista de categorías
        include('views/categoria/index.php'); // Carga la vista del índice
        break;
    }

    case 'eliminar': {
        if (!is_null($id) && is_numeric($id)) {
            $resultado = $app->delete($id); // Elimina la categoría

            if ($resultado) {
                $mensaje = "La categoría se eliminó correctamente";
                $tipo = "success";
            } else {
                $mensaje = "La categoría no se eliminó correctamente";
                $tipo = "danger";
            }
        }

        $categorias = $app->readAll(); // Actualiza la lista de categorías
        include('views/categoria/index.php'); // Carga la vista del índice
        break;
    }

    default: {
        $categorias = $app->readAll(); // Obtiene todas las categorías
        include 'views/categoria/index.php'; // Carga la vista del índice
        break;
    }
}
?>

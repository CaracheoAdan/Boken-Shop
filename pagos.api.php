<?php
header("Content-type: application/json; charset=utf-8");
require_once('venta.class.php');

$app = new venta();

$accion = $_SERVER['REQUEST_METHOD'];
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$data = [];

switch ($accion) {
    case 'POST': {
        $datos = $_POST;

        if (!is_null($id) && is_numeric($id)) {
            $resultado = $app->update($id, $datos);
        } else {
            $resultado = $app->create($datos);
        }

        $data['mensaje'] = ($resultado == 1) 
            ? "La venta se creó o actualizó correctamente."
            : "Ocurrió un error al procesar la venta.";

        break;
    }

    case 'DELETE': {
        if (!is_null($id) && is_numeric($id)) {
            $resultado = $app->delete($id);
            $data['mensaje'] = $resultado
                ? "La venta se eliminó correctamente."
                : "Ocurrió un error al eliminar la venta.";
        }
        break;
    }

    default: {
        if (!is_null($id) && is_numeric($id)) {
            $ventas = $app->readOne($id);
        } else {
            $ventas = $app->readAll();
        }

        $data = $ventas;
        break;
    }
}

echo(json_encode($data));
?>

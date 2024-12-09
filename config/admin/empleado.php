<?php
require_once('empleado.class.php');
$app = new Empleado();
$app->checkRole('Administrador'); // Verifica el rol de administrador
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        include 'views/empleado/crear.php';
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El empleado se agregó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al agregar el empleado";
            $tipo = "danger";
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    case 'actualizar':
        $empleado = $app->readOne($id);
        include('views/empleado/crear.php');
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        
        if ($resultado) {
            $mensaje = "El empleado se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar el empleado";
            $tipo = "danger";
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El empleado se ha eliminado correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Ocurrió un error al eliminar el empleado";
                    $tipo = "danger";
                }
            }
        }
        $empleados = $app->readAll();
        include("views/empleado/index.php");
        break;
    case 'imprimir':
        $app -> imprimir($id);
        die();
    default:
        $empleados = $app->readAll();
        include 'views/empleado/index.php';
}
require_once('views/footer.php');
?>

<?php
require_once ('empleado.class.php');
require_once ('usuario.class.php');
$appusuario = new usuario();
$app = new empleado();
$app -> checkRole('Administrador');

$accion = (isset($_GET['accion']))?$_GET['accion'] : NULL;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch ($accion) {
    case 'crear': {
        $usuarios = $appusuario -> readAll();
        include 'views/empleado/crear.php';
        break;
    }

    case 'nuevo': {
        $data=$_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "Empleado dada de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "El empleado no ha sido dado de alta";
            $tipo = "danger";
        }

        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    }

    case 'actualizar': {
        $empleados = $app -> readOne($id); 
        $usuarios = $appusuario -> readAll();
        include('views/empleado/crear.php');
        break;
    }
    
    case 'modificar': {
        $data= $_POST['data'];
        $result=$app->update($id,$data);
        if($result){
            $mensaje="El empleado se ha actualizado";
            $tipo="success";
        }else{
            $mensaje="No se ha actualizado";
            $tipo="danger";
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    }

    case 'eliminar': {
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app -> delete($id);
                if ($resultado) {
                    $mensaje = "El empleado se eliminó correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "El empleado no se eliminó correctamente";
                    $tipo = "danger";
                }
            }
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    }

    default: {
        $empleados = $app->readAll();
        include 'views/empleado/index.php';
        break;
    }
}
require_once('views/footer.php');
?>
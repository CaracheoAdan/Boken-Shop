<?php
require_once ('permiso.class.php');
$app = new permiso();
$app -> checkRole('Administrador');
$app -> checkRole('Administrador');

$accion = (isset($_GET['accion']))?$_GET['accion'] : NULL;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch ($accion) {
    case 'crear': {
        include 'views/permiso/crear.php';
        break;
    }

    case 'nuevo': {
        $data=$_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "Permiso dado de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "El permiso no ha sido dado de alta";
            $tipo = "danger";
        }

        $permisos = $app->readAll();
        include('views/permiso/index.php');
        break;
    }

    case 'actualizar': {
        $permisos = $app -> readOne($id); 
        include('views/permiso/crear.php');
        break;
    }
    
    case 'modificar': {
        $data= $_POST['data'];
        $result=$app->update($id,$data);
        if($result){
            $mensaje="El permiso se ha actualizado";
            $tipo="success";
        }else{
            $mensaje="No se ha actualizado";
            $tipo="danger";
        }
        $permisos = $app->readAll();
        include('views/permiso/index.php');
        break;
    }

    case 'eliminar': {
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app -> delete($id);
                if ($resultado) {
                    $mensaje = "El permiso se elimino correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "El permiso no se elimino correctamente";
                    $tipo = "danger";
                }
            }
        }
        $permisos = $app->readAll();
        include('views/permiso/index.php');
        break;
    }

    default: {
        $permisos = $app->readAll();
        include 'views/permiso/index.php';
        break;
    }
}

require_once('views/footer.php');
?>

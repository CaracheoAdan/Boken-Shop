<?php
require_once ('rol.class.php');
$app = new rol();
$app -> checkRole('Administrador');

$accion = (isset($_GET['accion']))?$_GET['accion'] : NULL;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch ($accion) {
    case 'crear': {
        include 'views/rol/crear.php';
        break;
    }

    case 'nuevo': {
        $data=$_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "rol dado de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "El rol no ha sido dado de alta";
            $tipo = "danger";
        }

        $roles = $app->readAll();
        include('views/rol/index.php');
        break;
    }

    case 'actualizar': {
        $roles = $app -> readOne($id); 
        include('views/rol/crear.php');
        break;
    }
    
    case 'modificar': {
        $data= $_POST['data'];
        $result=$app->update($id,$data);
        if($result){
            $mensaje="El rol se ha actualizado";
            $tipo="success";
        }else{
            $mensaje="No se ha actualizado";
            $tipo="danger";
        }
        $roles = $app->readAll();
        include('views/rol/index.php');
        break;
    }

    case 'eliminar': {
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app -> delete($id);
                if ($resultado) {
                    $mensaje = "El rol se elimino correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "El rol no se elimino correctamente";
                    $tipo = "danger";
                }
            }
        }
        $roles = $app->readAll();
        include('views/rol/index.php');
        break;
    }

    default: {
        $roles = $app->readAll();
        include 'views/rol/index.php';
        break;
    }
}

require_once('views/footer.php');
?>

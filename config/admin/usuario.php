<?php
require_once ('usuario.class.php');
include ('rol.class.php');

$app = new usuario();
$appRole = new rol();
 $app -> checkRole('Administrador');

$accion = (isset($_GET['accion']))?$_GET['accion'] : NULL;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch ($accion) {
    case 'crear': {
        $roles = $appRole -> readAll();
        $misRoles = $app -> readAllRoles($id);

        include 'views/usuario/crear.php';
        break;
    }

    case 'nuevo': {
        /*$data=$_POST['data'];*/
        $data=$_POST;

        /*print_r($_POST);*/
        /*die();*/

        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "Usuario dado de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "El usuario no ha sido dado de alta";
            $tipo = "danger";
        }

        $usuarios = $app->readAll();
        include('views/usuario/index.php');
        break;
    }

    case 'actualizar': {
        $usuario = $app -> readOne($id); 
        $roles = $appRole -> readAll();
        $misRoles = $app -> readAllRoles($id);

        include('views/usuario/crear.php');
        break;
    }
    
    case 'modificar': {
        $data= $_POST;
        $result=$app->update($id,$data);
        if($result){
            $mensaje="El usuario se ha actualizado";
            $tipo="success";
        }else{
            $mensaje="No se ha actualizado";
            $tipo="danger";
        }
        $usuarios = $app->readAll();
        include('views/usuario/index.php');
        break;
    }

    case 'eliminar': {
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app -> delete($id);
                if ($resultado) {
                    $mensaje = "El usuario se eliminó correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "El usuario no se eliminó correctamente";
                    $tipo = "danger";
                }
            }
        }
        $usuarios = $app->readAll();
        include('views/usuario/index.php');
        break;
    }

    default: {
        $usuarios = $app->readAll();
        include 'views/usuario/index.php';
        break;
    }
}
require_once('views/footer.php');
?>

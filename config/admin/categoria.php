<?php
require_once ('categoria.class.php');
$appCategorias = new categoria();
$app = new categoria();
 $app -> checkRole('Administrador');


$accion = (isset($_GET['accion']))?$_GET['accion'] : NULL;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch ($accion) {
    case 'crear': {
        $categorias = $appCategorias -> readAll();
        include 'views/categoria/crear.php';
        break;
    }

    case 'nuevo': {
        $data=$_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "categoria dada de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "La categoria no ha sido dado de alta";
            $tipo = "danger";
        }

        $categorias = $app->readAll();
        include('views/categoria/index.php');
        break;
    }

    case 'actualizar': {
        $categorias = $app -> readOne($id); 
        $categorias = $appCategorias -> readAll();
        include('views/categoria/crear.php');
        break;
    }
    
    case 'modificar': {
        $data= $_POST['data'];
        $result=$app->update($id,$data);
        if($result){
            $mensaje="La categoria se ha actualizado";
            $tipo="success";
        }else{
            $mensaje="No se ha actualizado";
            $tipo="danger";
        }
        $categorias = $app->readAll();
        include('views/categoria/index.php');
        break;
    }

    case 'eliminar': {
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app -> delete($id);
                if ($resultado) {
                    $mensaje = "La categoria se eliminó correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "La categoria no se eliminó correctamente";
                    $tipo = "danger";
                }
            }
        }
        $categorias = $app->readAll();
        include('views/categoria/index.php');
        break;
    }

    default: {
        $categorias = $app->readAll();
        include 'views/categoria/index.php';
        break;
    }
}
?>
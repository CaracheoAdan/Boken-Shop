<?php
require_once ('prenda.class.php');
require_once ('categoria.class.php');
$appPrenda = new prenda();
$app = new prenda();
 $app -> checkRole('Administrador');


$accion = (isset($_GET['accion']))?$_GET['accion'] : NULL;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch ($accion) {
    case 'crear': {
        $prendas = $appPrenda -> readAll();
        include 'views/prenda/crear.php';
        break;
    }

    case 'nuevo': {
        $data=$_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "prenda dada de alta correctamente";
            $tipo = "success";
        } else {
            $mensaje = "La prenda no ha sido dado de alta";
            $tipo = "danger";
        }

        $prendas = $app->readAll();
        include('views/prenda/index.php');
        break;
    }

    case 'actualizar': {
        $prendas = $app -> readOne($id); 
        $prendas = $appPrenda -> readAll();
        include('views/prenda/crear.php');
        break;
    }
    
    case 'modificar': {
        $data= $_POST['data'];
        $result=$app->update($id,$data);
        if($result){
            $mensaje="La prenda se ha actualizado";
            $tipo="success";
        }else{
            $mensaje="No se ha actualizado";
            $tipo="danger";
        }
        $prendas = $app->readAll();
        include('views/prenda/index.php');
        break;
    }

    case 'eliminar': {
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app -> delete($id);
                if ($resultado) {
                    $mensaje = "La prenda se eliminó correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "La prenda no se eliminó correctamente";
                    $tipo = "danger";
                }
            }
        }
        $prendas = $app->readAll();
        include('views/prenda/index.php');
        break;
    }

    default: {
        $prendas = $app->readAll();
        include 'views/prenda/index.php';
        break;
    }
}
?>
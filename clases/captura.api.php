<?php

require('../config/config.php');
require('../config/sistema.class.php');

$db = new sistema();
$con = $db->conexion();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

$accion = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;
$response = [];

switch ($accion) {
    case 'POST': {
        if (is_array($datos)) {
            $id_transaccion = $datos['detalles']['id'];
            $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
            $status = $datos['detalles']['status'];
            $fecha = $datos['detalles']['update_time'];
            $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));
            $email = $datos['detalles']['payer']['email_address'];
            $id_cliente = $datos['detalles']['payer']['payer_id'];

            if (!is_null($id) && is_numeric($id)) {
                $sql = $con->prepare('UPDATE compra SET fecha=?, status=?, email=?, id_cliente=?, total=? WHERE id_transaccion=?');
                $resultado = $sql->execute([$fecha_nueva, $status, $email, $id_cliente, $total, $id_transaccion]);
            } else {
                $sql = $con->prepare('INSERT INTO compra(id_transaccion, fecha, status, email, id_cliente, total) VALUES (?, ?, ?, ?, ?, ?)');
                $resultado = $sql->execute([$id_transaccion, $fecha_nueva, $status, $email, $id_cliente, $total]);
                $id = $con->lastInsertId();
            }

            if ($resultado) {
                $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

                if ($productos != null) {
                    foreach ($productos as $clave => $cantidad) {
                        $sql = $con->prepare("SELECT id, nombre, precio, descuento, ? AS cantidad FROM productos WHERE id=? AND activo=1");
                        $sql->execute([$cantidad, $clave]);
                        $row_prod = $sql->fetch(PDO::FETCH_ASSOC);

                        $precio = $row_prod['precio'];
                        $descuento = $row_prod['descuento'];
                        $precio_desc = $precio - (($precio * $descuento) / 100);

                        $sql_insert = $con->prepare("INSERT INTO detalle_compra (id_compra, id_producto, nombre, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
                        $sql_insert->execute([$id, $clave, $row_prod['nombre'], $precio_desc, $cantidad]);
                    }

                    include 'enviar_email.php';
                }

                unset($_SESSION['carrito']);
                $response['mensaje'] = 'La transacción se procesó correctamente.';
            } else {
                $response['mensaje'] = 'Ocurrió un error al procesar la transacción.';
            }
        } else {
            $response['mensaje'] = 'Los datos proporcionados no son válidos.';
        }
        break;
    }

    case 'DELETE': {
        if (!is_null($id) && is_numeric($id)) {
            $sql = $con->prepare('DELETE FROM compra WHERE id=?');
            $resultado = $sql->execute([$id]);

            $response['mensaje'] = $resultado
                ? 'La compra se eliminó correctamente.'
                : 'Ocurrió un error al eliminar la compra.';
        } else {
            $response['mensaje'] = 'ID no válido para eliminar la compra.';
        }
        break;
    }

    default: {
        if (!is_null($id) && is_numeric($id)) {
            $sql = $con->prepare('SELECT * FROM compra WHERE id=?');
            $sql->execute([$id]);
            $response = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = $con->prepare('SELECT * FROM compra');
            $sql->execute();
            $response = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
    }
}

echo json_encode($response);

?>

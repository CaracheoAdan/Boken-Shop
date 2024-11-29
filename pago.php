<?php 
require('header.php'); 
require ('config/config.php');
require('config/sistema.class.php');
$db = new Sistema();
$con = $db->conexion();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
// print_r($_SESSION);

$lista_carrito = array();

if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        $sql = $con->prepare("select id, nombre, precio, descuento, $cantidad as cantidad from productos 
        where id=? and activo = 1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}else {
    header("Location: index.php");
    exit;
}
// print_r($_SESSION);
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <strong>BOKEN SHOOP</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contacto</a>
                        </li>
                    </ul>
                    <a href="carrito.php" class="btn btn-primary">Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a>                
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4>Detalles de pago</h4>
                    <div id="paypal-button-container"></div>
                </div>
                <div class="col-6">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($lista_carrito == null) { ?>
                            <tr><td colspan="5" class="text-center"><b>No hay productos en el carrito</b></td></tr>
                        <?php 
                        } else {
                            $total = 0;
                            foreach ($lista_carrito as $producto) {
                                $_id = $producto['id'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio'];
                                $descuento = $producto['descuento'];
                                $cantidad = $producto['cantidad'];
                                $precio_desc = $precio - (($precio * $descuento) / 100);
                                $subtotal = $cantidad * $precio_desc;
                                $total += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $nombre; ?></td>
                            <td>
                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
    <td><strong>Total</strong></td>
    <td class="text-end">
        <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
    </td>
</tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
     </div>
 </div>
    </main>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>
    <script>
            paypal.Buttons({
                style: {
                    shape: 'pill',
                    color: 'blue',
                    label: 'pay'
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: <?php echo $total;?>,
                                currency_code: 'MXN'
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    let URL = 'clases/captura.php'
                    return actions.order.capture().then(function(detalles) {
                        alert('Pago aceptado!');
                        console.log(detalles); // Nos regresa detalles del pago
                        let url = 'clases/captura.php'
                        return fetch(url,{
                            method: 'post',
                            headers: {
                                'content-type': 'application/json'
                            },
                            body: JSON.stringify({
                                detalles: detalles
                            })
                        }).then(function(response){
                            window.location.href="completado.php" +detalles['id']; //$datos['detalles']['id']
                        })
                    });
                },
                onCancel: function(data) {
                    alert("Pago cancelado");
                    console.log(data); // Nos regresa un token que nos puede ayudar a registrar si se cancelo algun pago
                }
            }).render('#paypal-button-container');
        </script>
</body>
</html>

<?php require('footer.php'); ?>

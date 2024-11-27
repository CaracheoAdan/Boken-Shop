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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
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
                            <td><?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?></td>
                            <td>
                                <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                            </td>
                            <td>
                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                            </td>
                            <td>
                                <a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                    <button class="btn btn-primary btn-lg">Realizar pago</button>
                </div>
            </div>
        </div>
    </main>
     <!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de eliminar el producto de tu carrito?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button-elimina" class="btn btn-danger" onclick="elimina()">Eliminar</button>
      </div>
    </div>
  </div>
</div>                           
    <script>
   function actualizaCantidad(cantidad, id) {
    let url = 'clases/actualizar_carrito.php';
    let formData = new FormData();
    formData.append('action', 'agregar');
    formData.append('id', id);
    formData.append('cantidad', cantidad);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            // Actualiza el subtotal del producto
            let divsubtotal = document.getElementById('subtotal_' + id);
            divsubtotal.innerHTML = data.sub;

            // Recalcula el total global
            let total = 0.00;
            let list = document.getElementsByName('subtotal[]');

            // Suma los valores de los subtotales asegurándose de que sean válidos
            for (let i = 0; i < list.length; i++) {
                let valor = parseFloat(list[i].innerHTML.replace(/[$,]/g, ''));
                if (!isNaN(valor)) {
                    total += valor;
                }
            }

            // Formatea el total y lo muestra
            total = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2
            }).format(total);

            document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

    </script>
</body>
</html>

<?php require('footer.php'); ?>

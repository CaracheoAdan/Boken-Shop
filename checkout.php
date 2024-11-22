<?php 
      require('header.php'); 
      require ('config/config.php');
      require('config/sistema.class.php');
      $db = new Sistema();
      $con = $db->conexion();

      $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
      print_r($_SESSION);
    
       $lista_carrito = array();

      if ($productos != null){
        foreach ($productos as $clave => $cantidad){
            $sql = $con->prepare("select id, nombre, precio, descuento, $cantidad as cantidad from productos 
            where id=? and activo = 1");
            $sql -> execute([$clave]);
            $lista_carrito[] = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
      }

      
    
       print_r($_SESSION);
       //session_destroy();
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
                    <a href="carrito.php" class="btn btn-primary">Carrito<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
                    </a>                
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
                    </thead>
                </table>
            </div>
        </div>
    </main>
    <script>
    function addProducto(id, token) {
        let url = 'clases/carrito.php';
        let formData = new FormData();
        formData.append('id', id);
        formData.append('token', token);

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        })
        .then(response => response.json())
        .then(data => {
            if (data.ok) {
                let elemento = document.getElementById("num_cart");
                elemento.innerHTML = data.numero
            }
        })
    }
</script>
</body>
</html>

<?php require('footer.php'); ?>

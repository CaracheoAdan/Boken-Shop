<?php 
      require('header.php'); 
      require ('config/config.php');
      require('config/sistema.class.php');
      $db = new Sistema();
      $con = $db->conexion();

      $sql = $con->prepare("select id, nombre, precio from productos where activo = 1");
      $sql -> execute();
      $resultado = $sql ->fetchAll(PDO::FETCH_ASSOC);
    
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
            <div class="row">
                    <?php foreach($resultado as $row){ ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <?php 
                          $id = $row['id'];
                          $imagen = "images/productos/".$id."/principal.jpg";//La imagen se esta sacando dirrectamente de una carpeta y no de la base de datos
                          if(!file_exists($imagen)){
                              $imagen = "images/default.jfif";
                          }
                        ?>
                        <img src="<?php echo $imagen; ?>" alt="Blusa de mujer Azul" class="card-img-top" height="250" style="object-fit: cover;">
                        <div class="card-body" style="min-height: 150px;">
                            <h5 class="card-title"><?php echo $row['nombre']?></h5>
                            <p class="card-text">$<?php echo number_format($row['precio'],2, '.',',');?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                 <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                                </div>
                                    <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                                </div>
                        </div>
                    </div>
                </div>
              <?php }?>
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

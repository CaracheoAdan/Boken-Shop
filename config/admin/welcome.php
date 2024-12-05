<?php require_once('views/header/headerAdministrador.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Administrador</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f9f9f9; font-family: Arial, sans-serif;">
    <div style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px);"> <!-- Resta la altura del header -->
        <div style="text-align: center; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); max-width: 400px; width: 100%;">
            <h1 style="color: #0056b3; font-size: 24px; margin-bottom: 10px;">¡Bienvenido, Administrador!</h1>
            <p style="font-size: 16px; color: #555; margin-bottom: 20px;">
                Esta es la página de administración. Desde aquí puedes gestionar y supervisar todas las operaciones del sitio.
            </p>
            <a href="../../catalogo.php" style="display: inline-block; background-color: #0056b3; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-size: 16px;">Regresar al catálogo</a>
        </div>
    </div>
</body>
</html>
<?php require_once('views/footer.php'); ?>

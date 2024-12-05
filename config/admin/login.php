<?php
  require_once('../sistema.class.php');

  $app = new sistema;
  $accion = (isset($_GET['accion']))?$_GET['accion'] : NULL;

  switch ($accion) {
    case 'login': {
      $correo = $_POST['data']['correo'];
      $contrasena = $_POST['data']['contrasena'];
      if($app->login($correo, $contrasena)) {
          $mensaje = "Bienvenido al sistema";
          $tipo = "success";
          $_SESSION['rol'] = $app->checkRole('Administrador'); // Asegúrate de que el rol sea almacenado
          require_once('views/header/headerAdministrador.php');
          $app->alerta($tipo, $mensaje);
          header("Location: welcome.php"); // Redirige a la página de bienvenida
          exit;
      } else {
          $mensaje = "Correo o contraseña equivocados, <a href='login.php'>[presione aquí para volver a intentar]</a>";
          $tipo = "danger";
          require_once('views/header.php');
          $app->alerta($tipo, $mensaje);
          require_once('views/footer.php');
      }
  
      break;
  }
  

    case 'logout': {$app -> logout(); break;}
    
    default: {
      include('views/login/index.php');
      break;
    }
  }

  require_once('views/footer.php');
?>

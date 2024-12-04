<?php
  require_once('views/header.php');
?>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; border-radius: 15px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="user-icon" width="80" class="mb-3">
                <h3 class="card-title">Iniciar Sesión</h3>
            </div>
            <form method="post" action="login.php?accion=login">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" name="data[correo]" id="form2Example1" class="form-control" />
                    <label class="form-label" for="form2Example1">Correo electrónico</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="data[contrasena]" id="form2Example2" class="form-control" />
                    <label class="form-label" for="form2Example2">Contraseña</label>
                </div>

                <!-- Checkbox y Recuperar Contraseña -->
                <div class="d-flex justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Recuérdame </label>
                    </div>
                    <a href="login.php?accion=forgot">Recuperar contraseña</a>
                </div>

                <!-- Botón de inicio de sesión -->
                <button type="submit" value="entrar al sistema" name="enviar" class="btn btn-primary btn-block mb-4">Iniciar Sesión</button>

                <!-- Botones de registro y redes sociales -->
                <div class="text-center">
                    <p>¿No tienes cuenta? <a href="#!">Regístrate</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
  require('views/footer.php');
?>

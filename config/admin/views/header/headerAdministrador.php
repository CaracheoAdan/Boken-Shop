<?php
  require_once('views/header.php');
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Administrador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catalogos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="prenda.php">Prenda</a></li>
            <li><a class="dropdown-item" href="Categoria.php">Categoria</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuario</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuario">
            <li><a class="dropdown-item" href="usuario.php">Usuarios</a></li>
            <li><a class="dropdown-item" href="empleado.php">Empleados</a></li>
            <li><a class="dropdown-item" href="rol.php">Roles</a></li>
            <li><a class="dropdown-item" href="permiso.php">Permisos</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-disabled="false" href="login.php?accion=logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

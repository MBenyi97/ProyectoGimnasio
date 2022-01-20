<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="/home">BELLISIMA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/evento">Citas Eventos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/cita">Citas Clientes</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?= isset($_SESSION['empleado']) ? "/services/show" : "/services/showCliente" ?>">
          Nuestro Servicios</a>
      </li>
    </ul>


    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= isset($_SESSION['empleado']) ? "/employee/show" : "" ?>">
          <?= isset($_SESSION['empleado']) ? "Empleados" : "" ?></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?= isset($_SESSION['empleado']) ? "/login/logout" : "/login" ?>">
          <?= isset($_SESSION['empleado']) ? "Logout" : "Login" ?></a>
      </li>
    </ul>
  </div>
</nav>
<?php
session_start();
$hasLogin = isset($_SESSION['correo']);
if(!$hasLogin){
    header("Location:/app/login/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Tareas</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

</script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li>
        <a class="btn btn-danger" href="/app/login/loginController.php?option=logout">Cerrar sesión</a>
      </li>
      
    </ul>
  </div>
</nav>


<div class="card">
  <h5 class="card-header">Tarea 1</h5>
  <div class="card-body">
    <h5 class="card-title">Fumar marihuana</h5>
    <a href="#" class="btn btn-warning">Go somewhere</a>
    <a href="#" class="btn btn-danger">Go somewhere</a>
  </div>
</div>

<div class="card">
  <h5 class="card-header">Tarea 2</h5>
  <div class="card-body">
    <h5 class="card-title">atracar</h5>
    <a href="#" class="btn btn-warning">Go somewhere</a>
    <a href="#" class="btn btn-danger">Go somewhere</a>
  </div>
</div>


   


</body>
</html>


<?php
session_start();
$path = "/app";
$hasLogin = isset($_SESSION['correo']);
if ($hasLogin) {
  header("Location:$path/tareas/");
}

?>
<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../../src/css/style_login.css">
  <script>
    const login = () => {

      const correo = $('#correo').val();
      const password = $('#exampleInputPassword1').val();
      const option = 'login';
      $.ajax({
        type: "POST",
        url: "loginController.php",
        data: {
          correo,
          password,
          option
        },
        success: function(response) {

          if (response != 'Login exitoso') {
            $('#divResponse').html(`
            <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>${response}</div>
            </div>`);
            return;
          }
          window.location.href = '/app/tareas/';
        },
        error: function(error) {}
      });
    }
  </script>
</head>

<body class="p-5 m-5 border-15 bd-example m-0 border-0">

  <!-- <img src="../../src/img/fondo.jpg" alt=""> -->

  <div class="mb-3">
    <!-- Example Code -->

    <div class="container">
      <div class="row justify">
        <div class="col-auto">

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" aria-describedby="emailHelp">

          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Recordarme</label>
          </div>
          <button onclick="login()" class="btn btn-primary">Iniciar</button>
          <div class="mb-3" id="divResponse"></div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php
session_start();
$path = "/app";
$hasLogin = isset($_SESSION['correo']);
if($hasLogin){
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
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function login(){
      console.log("se ejecutara el login")
      const correo = $('#correo').val();
      const password = $('#exampleInputPassword1').val();
      const option = 'login';
      $.ajax({
        type: "POST",
        url: "loginController.php",
        data: {correo, password, option},
        success: function (response) {
          console.log(response);
        },
        error: function (error) {
          console.log(error);
        }
      });
    }

  </script>
  </head>

  <body class="p-3 m-0 border-0 bd-example m-0 border-0">

            

    <form method="POST" action="./loginController.php" >

      <div class="mb-3">
    <!-- Example Code -->
    
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
    
    <?php
    session_start();
    echo $_SESSION['correo'];
    ?>
  </body>
</html>
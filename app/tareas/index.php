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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Tareas</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
      $( document ).ready(()=>{
        consultarTareas();
        
      });

      const rellenar = (tarea)=>{
        const {contenido, titulo, id} = tarea;
        const misCards = $('#misCards');
          misCards.append(`<div class="col">
                <div class="p-3 border bg-light">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">${titulo}</h5>
                            <p class="card-text">${contenido}</p>
                            <a href="#" onclick="editarTarea(${id})" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="#" onclick="eliminarTarea(${id})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>`);
    }


    const eliminarTarea = (id)=>{
      console.log(id);
    }
    const editarTarea = (id)=>{
      console.log(id);
    }


    const consultarTareas = ()=>{
      $.ajax({
        type: "POST",
        url: "tareasController.php",
        data: {option: 'consultarTareas'},
        success: function (response) {
          $("#misCards").html('');
          console.log(response);
          const values = Object.values(response);
          console.log(values);
          values.forEach(tarea => {
            console.log(tarea);
            rellenar(tarea);
          });
        },
        error: function (error) {
          console.log(error);
        }
      });
    }


    </script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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

    <div class="container">
        <div class="row">
            <div class="col">
                <button onclick="rellenar()" class="btn btn-primary">Rellenar</button>
            </div>
            <div class="col">
                <button onclick="consultarTareas()" class="btn btn-primary">Consultar tareas</button>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3 md-2" id="misCards">
            
        </div>
    </div>


</body>

</html>
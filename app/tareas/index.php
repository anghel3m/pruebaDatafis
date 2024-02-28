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
    let idTarea = "";
    $(document).ready(() => {
        consultarTareas();

    });

    const rellenar = (tarea) => {
        const {
            contenido,
            titulo,
            id
        } = tarea;
        const misCards = $('#misCards');
        misCards.append(`<div class="col p-2">
                <div class="p-3 border bg-light">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">${titulo}</h5>
                            <p class="card-text">${contenido}</p>
                            <a href="#" onclick="mostrarModal('editar','${id}','${titulo}', '${contenido}')" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="#" onclick="eliminarTarea(${id})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>`);
    }


    const eliminarTarea = (id) => {
        Swal.fire({
            title: "¿Desea eliminar la tarea?",
            showCancelButton: true,
            confirmButtonText: "Si",
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
            type: "POST",
            url: "tareasController.php",
            data: {
                option: 'eliminarTarea',
                id
            },
            success: function(response) {
                console.log(response);
                consultarTareas();
            },
            error: function(error) {
                console.log(error);
            }
        });
        } else{
            return;
        }
        });
    }
    const editarTarea = () => {
        const titulo = $("#titulotarea").val();
        const contenido = $("#contenidoTarea").val();
        $.ajax({
            type: "POST",
            url: "tareasController.php",
            data: {
                option: 'editarTarea',
                id: idTarea,
                titulo,
                contenido
            },
            success: function(response) {
              idTarea = "";
                console.log(response);
                const {status, mensaje} = response;
                $('#exampleModalCenter').modal('hide');
                consultarTareas();
                mostrarAlerta({
                  title: "Tarea editada",
                  text: mensaje,
                  icon: status,
                  textButton: "Aceptar"
                })
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


    const consultarTareas = () => {
        $.ajax({
            type: "POST",
            url: "tareasController.php",
            data: {
                option: 'consultarTareas'
            },
            success: function(response) {
                $("#misCards").html('');
                console.log(response);
                const values = Object.values(response);
                console.log(values);
                values.forEach(tarea => {
                    console.log(tarea);
                    rellenar(tarea);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


    const mostrarModal = (opcion, id="", titulo="", contenido="") => {
      console.log(opcion);
      $("#btnGuardarTarea").hide();
      $("#btnEditarTarea").hide();
      $('#exampleModalCenter').modal('show'); 
      
      if(opcion=="editar"){
        idTarea = id;
        $("#titulotarea").val(titulo);
        $("#contenidoTarea").val(contenido);
        $("#btnEditarTarea").show();
      }else if(opcion=="nuevaTarea"){
        $("#btnGuardarTarea").show();
        $("#titulotarea").val("");
        $("#contenidoTarea").val("");
      }
    }


    const mostrarAlerta = ({title, text, icon, textButton})=>{
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: textButton
      })
    }


    $(document).on('click', 'button[name="closeModal"]', function() {
        $('#exampleModalCenter').modal('hide');
    });


    const guardarTarea = () => {
        const titulo = $("#titulotarea").val();
        const contenido = $("#contenidoTarea").val();
        $.ajax({
            type: "POST",
            url: "tareasController.php",
            data: {
                option: 'guardarTarea',
                titulo,
                contenido
            },
            success: function(response) {
                console.log(response);
                const {status, mensaje} = response;
                $('#exampleModalCenter').modal('hide');
                consultarTareas();
                mostrarAlerta({
                  title: "Tarea guardada",
                  text: mensaje,
                  icon: status,
                  textButton: "Aceptar"
                })
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    </script>
</head>

<body>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" name="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                  <label for="titulotarea" class="col-form-label">Titulo Tarea:</label>
                  <input type="text" class="form-control" id="titulotarea">
                </div>
                <div class="form-group">
                  <label for="contenidoTarea" class="col-form-label">Contenido Tarea:</label>
                  <input type="text" class="form-control" id="contenidoTarea">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" name="closeModal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="guardarTarea()" id="btnGuardarTarea" >Guardar tarea</button>
                    <button type="button" class="btn btn-primary" onclick="editarTarea() " id="btnEditarTarea">Editar tarea</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

<div class="container">
<ul class="nav row justify-content-between">

<li class="nav-item col-2">
<a class="nav-link" href="#">Datafis</a>
  </li> 

 

<li class="nav-item col-2">
  <a class="btn btn-danger" href="/app/login/loginController.php?option=logout">Cerrar sesión</a>
  </li>
  
</ul>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <button onclick="mostrarModal('nuevaTarea')" class="btn btn-primary">Crear Nueva Tarea</button>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3 md-2" id="misCards">

        </div>
    </div>


</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

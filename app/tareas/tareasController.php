<?php
require_once '../controladores/conexion.php';


$option = isset($_POST['option']) ? $_POST['option'] : $_GET['option'];

if ($option == 'consultarTareas') {
    consultarTareas();
} else if ($option == 'eliminarTarea') {
    eliminarTarea();
} else if ($option == 'editarTarea') {
    editarTarea();
} else if ($option == 'guardarTarea') {
    guardarTarea();
} else {
    echo "Opción no válida";
}

function consultarTareas()
{
    global $conexion;
    $sql = "SELECT * FROM tareas order by ID desc";
    $result = $conexion->query($sql);
    $tareas = [];
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['ID'];
            $titulo = $row['TITULO'];
            $contenido = $row['CONTENIDO'];
            $tareas[] = ['id' => $id, 'titulo' => $titulo, 'contenido' => $contenido];
        }
    } else {
        $tareas = ['error' => 'No hay tareas', 'sql' => $sql];
    }
    header('Content-Type: application/json');
    echo json_encode($tareas);
}


function eliminarTarea()
{
    global $conexion;
    $id = $_POST['id'];
    $sql = "DELETE FROM tareas WHERE ID = $id";
    $result = $conexion->query($sql);
    if ($result->rowCount() > 0) {
        $response = ['status' => 'success', "mensaje" => 'Tarea eliminada'];
    } else {
        $response = ['status' => 'error', "mensaje" => 'No se pudo eliminar la tarea', 'status' => 'sql', "mensaje" => $sql];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function editarTarea()
{
    global $conexion;
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $sql = "UPDATE tareas SET TITULO = '$titulo', CONTENIDO = '$contenido' WHERE ID = $id";
    $result = $conexion->query($sql);
    if ($result->rowCount() > 0) {
        $response = ['status' => 'success', "mensaje" => 'Tarea actualizada'];
    } else {
        $response = ['status' => 'error', "mensaje" => 'No se pudo actualizar la tarea', 'sql' => $sql];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function guardarTarea()
{
    global $conexion;
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $sql = "INSERT INTO tareas (TITULO, CONTENIDO) VALUES (:titulo, :contenido)";
    $strm = $conexion->prepare($sql);
    $strm->bindParam(':titulo', $titulo);
    $strm->bindParam(':contenido', $contenido);
    $strm->execute();
    if ($strm->rowCount() > 0) {
        $response = ['status' => 'success', "mensaje" => 'Tarea guardada'];
    } else {
        $response = ['status' => 'error', "mensaje" => 'No se pudo guardar la tarea', 'sql' => $sql];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

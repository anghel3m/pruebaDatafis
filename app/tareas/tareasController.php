<?php
require_once '../controladores/conexion.php';


$option = isset($_POST['option']) ? $_POST['option'] : $_GET['option'];

if($option == 'consultarTareas'){
    consultarTareas();
}else{
    echo "Opción no válida";
}

function consultarTareas(){
    global $conexion;
    $sql = "SELECT * FROM tareas";
    $result = $conexion->query($sql);
    $tareas = [];
    if($result->rowCount() > 0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $id = $row['ID'];
            $titulo = $row['TITULO'];
            $contenido = $row['CONTENIDO'];
            $tareas[] = ['id' => $id, 'titulo' => $titulo, 'contenido' => $contenido];
        }
    }else{
        $tareas = ['error' => 'No hay tareas', 'sql' => $sql];
    }
    header('Content-Type: application/json');
    echo json_encode($tareas);
}

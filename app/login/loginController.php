<?php
require_once '../controladores/conexion.php';

$option = isset($_POST['option']) ? $_POST['option'] : $_GET['option'];


if ($option == 'login') {
    login();
} elseif ($option == 'logout') {
    logout();
} else {
    echo "Opcion no valida";
}

function login()
{
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    if ((empty($correo)) && (empty($password)) ) {

        echo 'Los campos no pueden estar vacío.';
      }else{
    global $conexion;
    $stmt = $conexion->prepare("SELECT PASS, NOMBRE FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $row = $resultado->fetch(PDO::FETCH_ASSOC);
        $otraPass = $row['PASS'];
        $nombre = $row['NOMBRE'];
        if (password_verify($password, $otraPass)) {
            session_start();
            $_SESSION['correo'] = $correo;
            $_SESSION['nombre'] = $nombre;
            echo 'Login exitoso';
        } else {
            echo 'Contraseña incorrecta';
        }
    } else {
        echo 'intenta nuevamente';
    }
}
}


function logout()
{
    session_start();
    session_destroy();
    // echo 'Sesion cerrada';
    header('Location: ../../index.php');
}

<?php
require_once '../controladores/conexion.php';

$option = isset($_POST['option']) ? $_POST['option'] : $_GET['option'];



if($option == 'login'){
    login();
}elseif($option == 'register'){
    register();
}elseif($option == 'logout'){
    logout();
}else{
    echo "Opcion no valida";
}

function login()
{
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    global $conexion;
    $stmt = $conexion->prepare("SELECT PASS, NOMBRE FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    if($stmt->rowCount() == 1){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $row = $resultado->fetch(PDO::FETCH_ASSOC);
        $otraPass = $row['PASS'];
        $nombre = $row['NOMBRE'];
        if(password_verify($password, $otraPass)){
            session_start();
            $_SESSION['correo'] = $correo;
            $_SESSION['nombre'] = $nombre;
            echo 'Login exitoso';
        }else{
            echo 'Contraseña incorrecta';
        }
    }else{
        echo 'Usuario no existe';
    }
}


function register(){
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    global $conexion;
    $sql = "INSERT INTO usuarios (correo, pass) VALUES ('$correo', '$password');";
    echo $sql;
    $resultado = $conexion->query($sql);
    if($resultado->rowCount() == 1){
        echo 'Registro exitoso';
        // session_start();
        // header('Location: ../home/home.php');
    }else{
        // header('Location: ../index.php');
        echo 'Usuario no existe o contraseña incorrecta';
    }
}


function logout(){
    session_start();
    session_destroy();
    // echo 'Sesion cerrada';
    header('Location: ../../index.php');
}


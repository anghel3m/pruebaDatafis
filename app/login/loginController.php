<?php
require_once '../controladores/conexion.php';

$option = $_POST['option'];



if($option == 'login'){
    echo login();
}elseif($option == 'register'){
    register();
}elseif($option == 'logout'){
    logout();
}else{
    echo "errror 700000";
}

function login()
{
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    global $conexion;
    $sql = "SELECT * FROM usuarios WHERE correo ='$correo';";
    hash('sha256', $password);
    $resultado = $conexion->query($sql);
    if($resultado->rowCount() == 1){
        $row = $resultado->fetch(PDO::FETCH_ASSOC);
        $otraPass = $row['PASS'];
        if(password_verify($password, $otraPass)){
            session_start();
            $_SESSION['correo'] = $correo;
            echo 'Login exitoso';
        }else{
            echo 'Usuario no existe o contraseña incorrecta1';
        }
        // $_SESSION['id'] = $row['ID'];
    }else{
        // header('Location: ../index.php');
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
    echo 'Sesion cerrada';
}


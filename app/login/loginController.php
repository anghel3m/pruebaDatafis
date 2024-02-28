<?php
require_once '../controladores/conexion.php';

$option = $_POST['option'];



if($option == 'login'){
    login();
}elseif($option == 'register'){
    register();
}
else{
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
            echo 'Login exitoso';
        }else{
            echo 'Usuario no existe o contraseña incorrecta';
        }
        session_start();
        $_SESSION['correo'] = $correo;
        // $_SESSION['id'] = $row['ID'];
        header('Location: /tareas/index.php');
    }else{
        // header('Location: ../index.php');
        echo 'Usuario no existe o contraseña incorrecta';
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


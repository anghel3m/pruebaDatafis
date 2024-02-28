<?php
session_start();
$path = "/app";
$hasLogin = isset($_SESSION['correo']);
if(!$hasLogin){
    header("Location:$path/login/");
    // die();
}else{
    header("Location:$path/tareas/");
    // die();
}
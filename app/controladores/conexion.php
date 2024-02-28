<?php
session_start();

//credenciales de acceso a la base datos
$servidor = "db";
$usuario = "anghel3m";
$password = "123";


try {
    $conexion =  new PDO("mysql:host=$servidor;dbname=usuario", $usuario, $password);
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




    // echo "conexion establecida";

} catch (PDOException $error) {

    // echo "conexion erronea <br>" . $error;
}

?>
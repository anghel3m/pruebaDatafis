<?php


session_start();

//credenciales de acceso a la base datos
$servidor = "localhost";
$usuario = "anghel3m";
$password = "123";


try {
    $conexion =  new PDO("mysql:host=$servidor;dbname=usuario", $usuario, $password);
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `fotos`";



    echo "conexion establecida";

} catch (PDOException $error) {

    echo "conexion erronea <br>" . $error;
}

?>
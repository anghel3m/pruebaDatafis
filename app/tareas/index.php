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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    rgarg
</body>
</html>


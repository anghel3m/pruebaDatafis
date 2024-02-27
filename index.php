<?php
session_start();
$path = "./app";
$hasLogin = isset($_SESSION['email']);
if(!$hasLogin){
    header("Location:$path/login/");
    die();
}else{
    header("Location:$path/home/");
    die();
}
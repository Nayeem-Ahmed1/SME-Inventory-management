<?php 

session_start();

$continue = isset($_SESSION['user_id']);

if($continue){
    header('Location: dashboard.php');
    die();
}
else{
    header('Location: login.php');
    die();
}
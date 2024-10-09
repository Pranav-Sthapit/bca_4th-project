<?php
session_start();
include '../schema_and_register/functions.php';
$user_id=$_SESSION["user_id"];
$password;
$pin;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $password=$_POST["password"];
        $pin=$_POST["pin"];
    }
    changePassword($user_id,$password);
    changePin($user_id,$pin);
    session_destroy();
?>
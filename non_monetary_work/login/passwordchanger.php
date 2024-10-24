<?php
session_start();
include '../schema_and_register/functions.php';
$user_id=$_SESSION["user_id"];
$password;

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $password=$_POST["newPass"];
    }
    changePassword($user_id,$password);
    session_destroy();
?>
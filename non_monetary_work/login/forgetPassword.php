<?php
session_start();
include '../schema_and_register/functions.php';

//enter userid
    $user_id;   /*=9860325051;$_SESSION["user_id"]=$user_id;*/
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $user_id=$_POST["userId"];
        $_SESSION["user_id"]=$user_id;
    }
//end

    $registered_email=emailViaUserID($user_id);
    if($registered_email==-1){
        die("there is no user id");
    }
include '../schema_and_register/otpform.php';
?>

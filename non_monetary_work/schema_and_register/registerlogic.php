<?php
session_start();
include 'functions.php';


//html to php input data logic
/*
$user_id=9860325051;$_SESSION["user_id"]=$user_id;
$password="pranav";$_SESSION["password"]=$password;
$pin=1234;$_SESSION["pin"]=$pin;
$acc_no=12345;$_SESSION["acc_no"]=$acc_no;
*/
$user_id;$password;$pin;$acc_no;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $user_id=$_POST["userId"];$_SESSION["user_id"]=$user_id;
    $password=$_POST["password"];$_SESSION["password"]=$password;
    $pin=$_POST["pin"];$_SESSION["pin"]=$pin;
    $acc_no=$_POST["accNo"];$_SESSION["acc_no"]=$acc_no;
}
//end of logic


//some extras
$citizenship_no;
$registered_email=selectingEmailForRegistration($acc_no);
//
if($registered_email!=-1){
include 'otpform.php';
}
?>




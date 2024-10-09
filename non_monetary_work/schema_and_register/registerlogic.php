<?php
session_start();
include 'functions.php';


//html to php input data logic
$user_id=9860325051;$_SESSION["user_id"]=$user_id;
$password="pranav";$_SESSION["password"]=$password;
$pin=1234;$_SESSION["pin"]=$pin;
$acc_no=12345;$_SESSION["acc_no"]=$acc_no;
//end of logic

//some extras
$citizenship_no;
$registered_email=selectingEmailForRegistration($acc_no);
//
include 'otpform.php';
?>




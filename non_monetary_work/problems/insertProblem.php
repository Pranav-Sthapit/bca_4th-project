<?php
    session_start();
    //code to get email and message
    $email="pranavsthapit17@gmail.com";
    $message="this is a demo problem";
    //end
    //user id through session but for now let suppose
    //$user_id=$_SESSION["user_id"];
    $user_id=9860325051;

    $conn=new mysqli('localhost','root','','swift_bank');
    if($conn->connect_error)
    {
        die("connection failed");
    }
    $sql=$conn->prepare("INSERT into problem values(?,?,?)");
    $sql->bind_param('ssi',$email,$message,$user_id);
    if($sql->execute())
    {
        echo "your response has been sent";
    }else{
        echo "response not sent";
    }
    $sql->close();
    $conn->close();
?>
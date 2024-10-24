<?php
    function loginValidation($user_id,$password){
        $conn=new mysqli('localhost','root','','swift_bank');
        if($conn->connect_error)
        {
            die("connection failed");
        }

        $sql=$conn->prepare("SELECT user_id,password from user where user_id=? and password=?");
        $sql->bind_param('is',$user_id,$password);
        $sql->execute();
        $result=$sql->get_result();
        if($result->num_rows==1)
        {
            echo "login success";
        }else{
            echo "invalid user id or password";
        }
        $sql->close();
        $conn->close();
    }
    //logic for user input
    $user_id;$password;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $user_id=$_POST["userId"];
        $password=$_POST["password"];
    }
    //end logic
    loginValidation($user_id,$password);

?>
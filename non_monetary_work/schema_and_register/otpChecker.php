<?php
session_start();
//getting the otp from user to php
    $otp_inputted;$user_id;$password;$pin;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $otp_inputted=$_POST["otp_input"];
    }
    //test otp match or not
    if($otp_inputted!=$_SESSION["OTP"])
    {
        echo "otp not match";
        echo $_SESSION["OTP"];
        echo $otp_inputted;
    }
    else{
        //if otp match the use sessions to retrive stored data of user;
        $user_id=$_SESSION["user_id"];
        $password=$_SESSION["password"];
        $pin=$_SESSION["pin"];
        $acc_no=$_SESSION["acc_no"];

    //again create connection    
    $server="localhost";
    $user="root";
    $dbpassword="";
    $db="swift_bank";
    $conn=new mysqli($server,$user,$dbpassword,$db);

    if($conn->connect_error)
    {
        die("connection failed");
    }
    //insert the values into respective tables via query
    $sql=$conn->prepare("INSERT into user values(?,?,?)");
    $sql->bind_param('isi',$user_id,$password,$pin);
    

    $sql2=$conn->prepare("UPDATE account set user_id=? where acc_no=? and user_id is null");
    $sql2->bind_param('ii',$user_id,$acc_no);
    

    $sql3=$conn->prepare("UPDATE account_holder set user_id=? where citizenship_no=(select citizenship_no from account where acc_no=?) and user_id is null");
    $sql3->bind_param('ii',$user_id,$acc_no);
   



    try{
        //executing queries
        $first=$sql->execute();
        $second=$sql2->execute();
        $third=$sql3->execute();
    if($first==TRUE && $second==TRUE && $third==TRUE)
    {
        echo "you are now registered as a user";
        echo "if you are trying to register with a different user id to same acc_no then you will not have access to the bank facilities please refer to bank";
    }
    }catch(exception $e){
        echo "this account is alerady registered for online banking";
    }finally{
        $sql->close();
        $sql2->close();
        $sql3->close();
        $conn->close();
        //close connection
    }
    }
    session_destroy();
?>
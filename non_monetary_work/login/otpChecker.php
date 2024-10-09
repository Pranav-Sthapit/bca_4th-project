 <?php
 session_start();
    
    $otp_inputted;$user_id;
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
    }else{
        header("Location:passwordandpinform.html");
        exit();
        //send to a form  
    }
?>
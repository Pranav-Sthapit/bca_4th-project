<?php
session_start();
include '../getAccNo.php';
include '../balanceAlter.php';
include '../transactionTableFunction.php';
function createFD($amount,$interest,$date_of_maturity,$user_id,$acc_no){
    $conn=new mysqli("localhost",'root','','swift_bank');
    if($conn->connect_error)
    {
    die("connection failed");
    }
    $date=date("Y-m-d");
    $sql=$conn->prepare("INSERT INTO fixed_deposit(amount,interest,date_created,date_matured,user_id,acc_no) values (?,?,?,?,?,?)");
    $sql->bind_param('iissii',$amount,$interest,$date,$date_of_maturity,$user_id,$acc_no);
    $sql->execute();
    $conn->close();
}

    //input from user
    $user_id=9860325051;
    $amount=10000;
    $date_of_maturity="2025-1-1";
    //end
    $interest=$amount*10/100;
    $acc_no=getAccNo($user_id);
    
    include '../pincheck.php';
    if($pinValid==1){
    try{
        deductFromAccount($user_id,$amount);
    }catch(exception $e){
        die("unable to create minimum balance of 1000 must be maintained");
    }
    try{
        createFD($amount,$interest,$date_of_maturity,$user_id,$acc_no);
        putInTransaction($amount,null,null,"fixed deposit",$user_id);
        $_SESSION["result_message"]="fd created";
        header("Location:../messageBox.php");
    }catch(exception $e){
        addToAccount($user_id,$amount);
        $_SESSION["result_message"]="cannot create more than 1 fd at a time";
        header("Location:../messageBox.php");
    }
}

?>
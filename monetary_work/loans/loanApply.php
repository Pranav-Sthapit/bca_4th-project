<?php

function getAccNo($user_id){
$conn=new mysqli('localhost','root','','swift_bank');
if($conn->connect_error)
{
    die("connection failed");
}
$sql=$conn->prepare("SELECT acc_no from account where user_id=?");
$sql->bind_param('i',$user_id);
$sql->execute();
$result=$sql->get_result();
$row=$result->fetch_assoc();
$sql->close();
$conn->Close();
return $row["acc_no"];

}
//user id form session let
$user_id=9860325051;
//get loan amount 
$amount=1000;
//
$interest=$amount*10/100;
$acc_no=getAccNo($user_id);

$conn=new mysqli('localhost','root','','swift_bank');
if($conn->connect_error)
{
    die("connection failed");
}
$sql2=$conn->prepare("INSERT into loan(amount_due,interest,status,user_id,acc_no) values(?,?,'requesting',?,?)");//insert loan referal
$sql2->bind_param('iiii',$amount,$interest,$user_id,$acc_no);
try{
    $sql2->execute();
    echo"loan request sent";
}catch(exception $e)
{
    echo "loan request cannot be sent <br> if you already have a loan request or pending payment then you cannot apply for more <br>
     if you donot have any loans please refer to bank";
}finally{
    $sql2->close();
}
$conn->close();
?>
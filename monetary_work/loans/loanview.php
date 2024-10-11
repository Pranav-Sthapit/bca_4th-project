<?php
//get user id via session
$user_id=9860325051;

$conn=new mysqli('localhost','root','','swift_bank');
if($conn->connect_error)
{
    die("connection failed");
}
$sql=$conn->prepare("SELECT * from loan where user_id=?");//display every column of loan for user
$sql->bind_param('i',$user_id);
$sql->execute();
$result=$sql->get_result();
if($result->num_rows==1)
{
    $row=$result->fetch_assoc();
    echo $row["loan_id"]." ".$row["amount_due"]." ".$row["interest"]." ".$row["status"]." ".$row["acc_no"];
}else{
    echo "no loans";
}
$sql->close();
$conn->close();
?>
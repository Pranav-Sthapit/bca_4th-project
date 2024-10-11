<?php
//logic to see if user wants to cancel loan html from another page
//end
$user_id=9860325051;//from session
$conn=new mysqli('localhost','root','','swift_bank');
if($conn->connect_error)
{
    die("connection failed");
}
$sql=$conn->prepare("DELETE from loan where user_id=? and status='requesting'");//delete loan referal
$sql->bind_param('i',$user_id);
$sql->execute();
if($sql->affected_rows==1)
{
    echo "loan request cancelled";
}else{
    echo "approved loan cannot be cancelled";
}
$sql->close();
$conn->close();
?>
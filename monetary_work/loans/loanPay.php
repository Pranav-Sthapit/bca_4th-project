<?php
include '../transactionTableFunction.php';
//get money amount to pay must equal interest and principal lumpsum pay
$amount=1100;
//end
$amountDue;
$user_id=9860325051;//from session
$conn=new mysqli('localhost','root','','swift_bank');
if($conn->connect_error)
{
    die("connection failed");
}
$sqlamtDue=$conn->prepare("SELECT amount_due+interest as total_amt from loan where user_id=? and status='approved'");//select total loan with interest
$sqlamtDue->bind_param('i',$user_id);
$sqlamtDue->execute();
$result=$sqlamtDue->get_result();
$sqlamtDue->close();
$conn->close();
if($result->num_rows==1)
{   $totalDue=$result->fetch_assoc();
    $amountDue=$totalDue["total_amt"];
if($amount!=$amountDue)
{
    echo "must pay full amount with interest";
}else{
    include '../pincheck.php';
    if($pinValid==1){
        $conn=new mysqli('localhost','root','','swift_bank');
    $sql=$conn->prepare("UPDATE account set balance=balance-? where user_id=?");//deduct from the account if possible
    $sql->bind_param('ii',$amount,$user_id);
    try
    {   $sql->execute();
        $sql2=$conn->prepare("DELETE from loan where user_id=?");//remove the loan from table
        $sql2->bind_param('i',$user_id);
        $sql2->execute();
        echo "loan paid";
        putInTransaction($amount,null,null,"loan pay",$user_id);//enter as recorded transaction
    }catch(exception $e){
        echo "insufficient balance mimimum balance must be above 1000";
    }finally{
        $sql->close();
        $sql2->close();
        $conn->close();
    }
    }
}
}else{
    echo "no loans";
}
?>
<?php
include '../getAccNo.php';
include '../transactionTableFunction.php';
include '../balanceAlter.php';



//get user inputs
$user_id=9860325051;
$amount=200;
$receiver_id=9860325050;
$type="transfer";
//end

$receiver_acc_no=getAccNo($receiver_id);
if($receiver_acc_no==-1){
    echo "no account to transfer";
}else{
    try{
        deductFromAccount($user_id,$amount);
        addToAccount($receiver_id,$amount);
        putInTransaction($amount,$receiver_id,$receiver_acc_no,$type,$user_id);
        echo "transfer success";
        }catch( exception $e){
            echo "insufficient minimum balance for transfer <br>1000 must be left";
        }
}


?>
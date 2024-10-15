<?php
include '../getAccNo.php';
include '../balanceAlter.php';
include '../transactionTableFunction.php';

    //input from user
    $user_id=9860325051;
    $amount=100;
    //end
    $acc_no=getAccNo($user_id);
    
     //pin enter in form
include '../pincheck.php';
//end
if($pinValid==1){ //if pin is valid from the included document then do the following
    try{
        deductFromAccount($user_id,$amount);
        putInTransaction($amount,null,null,"wallet load",$user_id);
        echo "wallet has been loaded check the transaction history";
    }catch(exception $e){
        die("unable to load wallet minimum balance of 1000 must be maintained");
    }
}

?>
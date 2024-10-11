<?php
    //user input date
    $date="2024-10-11";
    $user_id=9860325051;
    //end

    $conn=new mysqli("localhost",'root','','swift_bank');
    if($conn->connect_error)
    {
    die("connection failed");
    }
    $sql=$conn->prepare("SELECT * from transaction where (user_id=? or receiver_id=?) and date_of_transaction=?");
    $sql->bind_param('iis',$user_id,$user_id,$date);
    $sql->execute();
    $result=$sql->get_result();
    if($result->num_rows>=1)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<p>".$row["date_of_transaction"]." ".$row["amount"]." ".$row["receiver_id"]." ".$row["receiver_acc_no"]." ".$row["transaction_type"]." ".$row["user_id"]."</p>";
        }
    }else{
        echo "no transactions in this date";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer History</title>
    <link rel="stylesheet" href="../../css/chillistyle.css">
</head>
<body>
    <!-- Navigation bar with Swift logo and text -->
    <header>
        <nav class="navbar">
            <div class="nav-logo">
                <img src="swift-logo.png" alt="Swift Logo">
                <span>Swift</span>
            </div>
        </nav>
    </header>

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
   /* if($result->num_rows>=1)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<p>".$row["date_of_transaction"]." ".$row["amount"]." ".$row["receiver_id"]." ".$row["receiver_acc_no"]." ".$row["transaction_type"]." ".$row["user_id"]."</p>";
        }
    }else{
        echo "no transactions in this date";
    }*/
?>


    <!-- Main container for Transfer History -->
    <div class="container">
        <div class="transfer-history-box">
            <h2>Transfer History</h2>

            <!-- Transfer History List -->
            <div class="transaction-list">

            <?php
            if($result->num_rows>=1)
            {
                while($row=$result->fetch_assoc())
                {
                echo '
                    <div class="transaction-item">
                        <div class="icon">
                            <img src="transaction-icon.png" alt="Transaction Icon">
                        </div>
                        <div class="transaction-details">
                            <div class="description">
                                <strong>'.$row["transaction_type"].'</strong>
                                <p>TD:'.$row["receiver_id"].'</p>
                                <p>Acc_no:'.$row["receiver_acc_no"].'</p>
                            </div>
                            <div class="amount-status">
                                <span class="amount">NRs.'.$row["amount"].'</span>
                                <span class="status paid">'.($row["receiver_id"] == $user_id ? 'received' : 'paid').'<!--paid or received--></span>
                                <span class="date-time">'.$row["date_of_transaction"].'</span>
                            </div>
                        </div>
                    </div>
                ';}
            }else{
                echo "<p>no transactions in this date</p>";
            }
            ?>
            </div>
        </div>
    </div>
</body>
</html>

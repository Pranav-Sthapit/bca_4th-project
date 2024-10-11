<?php 
    function viewFD($user_id){
    $conn=new mysqli("localhost",'root','','swift_bank');
    if($conn->connect_error)
    {
    die("connection failed");
    }
    $date=date("Y-m-d");
    $sql=$conn->prepare("SELECT * from fixed_deposit where user_id=?");
    $sql->bind_param('i',$user_id);
    $sql->execute();
    $result=$sql->get_result();
    if($result->num_rows==1){
        $row=$result->fetch_assoc();
        echo $row["fd_id"]." ".$row["amount"]." ".$row["interest"]." ".$row["date_created"]." ".$row["date_matured"]." ".$row["user_id"]." ".$row["acc_no"];
    }else{
        echo "no fd";
    }
}

viewFD(9860325051);
?>
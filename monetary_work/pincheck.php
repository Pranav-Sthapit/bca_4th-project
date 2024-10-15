<html>
    <head>
        <script>
            function validate(){
                patt=/^[0-9]{4}$/;
                a=document.pinform.pin.value;
                if(!patt.test(a))
            {
                alert("pin must be 4 digit number");
                return false;
            }
            }
        </script>
    </head>
    <body>
        <?php
            //this document will be included in otherrs so user_id will be present in the other documents
            $pin="";
            $pinValid="";
        ?>
        <form name="pinform" method="post" action="" onsubmit="return validate()">
            Enter Pin:<input type="text"  name="pin" required> <br>
            <input type="submit" value="submit">
        </form>
        <?php

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $pin=$_POST["pin"];
        $conn=new mysqli('localhost','root','','swift_bank');
        $sql=$conn->prepare("SELECT pin from user where user_id=?");
        $sql->bind_param('i',$user_id);//user id from here is in other document
        $sql->execute();
        $result=$sql->get_result();
        $row=$result->fetch_assoc();
        $conn->close();
    if($row['pin']==$pin){ 
        $pinValid=1;
    }else{
        die("pin not matched");
    }
    }
?>
    </body>
</html>

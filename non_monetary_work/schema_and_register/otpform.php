<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="../../css/otp.css">
        <script>
            function sendotp(){
                <?php
                sendOTPphp($registered_email);
                //sending otp always executes when page refresh 
                ?>
            }    
            function validate(){
                //validate empty otp
                a=document.otp_form.otp_input.value;
                if(a==null || a=="")
            {   alert("enter otp");
                return false;
            }
            }
        </script>
    </head>

<body>
        <!-- the otp form-->
        <div class="otp">
        <h2>Enter OTP</h2>
        <form name="otp_form" method="post" action="otpChecker.php" onsubmit="return validate()">
            <input type="text" name="otp_input" class="otp_input" placeholder="enter 6 digit OTP just sent to mail" maxlength="6">
            <input type="submit" class="submit" value="Submit">
        <a href="#" class="resend" onclick="sendotp()">Resend OTP</a>
        </form>
        </div>
</body>
</html>
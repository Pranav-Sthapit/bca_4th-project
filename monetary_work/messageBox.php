<html>
<body>
<h1><?php 
session_start();
try{
    echo $_SESSION["result_message"];
 }catch(exception $e){
    echo "nothing to display";
 }
?></h1>
</body>
</html>
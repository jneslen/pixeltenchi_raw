<?php
//This Script is Written by Jeffrey Neslen and is copyrighted SM Media

$to = "jneslen@yahoo.com";
$subject = "A new contact message from PixelTenchi.com";

$message ='
<html>
<title>Submitted to pixeltenchi.com</title>
<body>
Name: 
';
$message .="$name";
$message .='
<br><br>
E-Mail:
';
$message .= "$email";
$message .='
<br><br>
Message:<br>
';
$message .="$message";
$message .='
<br>
</body>
</html>
';

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: $email\r\n";

mail($to,$subject,$message,$headers);

$sTheNameVariable = $_POST["name"];
$sTheEmailVariable = $_POST["email"];
$sTheMessageVariable = $_POST["message"];

echo"$sTheNameVariable$sTheEmailVariable$sTheMessageVariable";
?>


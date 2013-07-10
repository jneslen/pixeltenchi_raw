<?php
//This Script is Written by Jeffrey Neslen and is copyrighted SM Media

$to = "admin@nectartech.com";
$subject = "Thanks for Contacting Nectartech";

$message ='
<html>
<title>Submitted to Nectartech</title>
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
Phone Number:
';
$message .= "$phone";
$message .='
<br><br>
Package Interest:
';
$message .= "$package";
$message .='
<br><br>
Comments:<br>
';
$message .="$comments";
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
$sThePhoneVariable = $_POST["phone"];
$sThePackageVariable = $_POST["package"];
$sTheCommentsVariable = $_POST["comments"];

echo"$sTheNameVariable$sTheEmailVariable$sThePhoneVariable$sThePackageVariable$sTheCommentsVariable";
?>


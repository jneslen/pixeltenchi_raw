<?php
$to = "jneslen@yahoo.com";
$subject = "Thanks for Contacting Nectartech";

$message = '
<html>
<title>Submitted to Nectartech</title>
<body>
Name: 
';
$message .="$name";
$message .='
<br>
E-Mail:
';
$message .= "$email";
$message .='
<br>
Phone Number:
';
$message .= "$phone";
$message .='
<br>
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

mail($email,$subject,$message,$headers);

$sTheNameVariable = $_POST["name"];
$sTheEmailVariable = $_POST["email"];
$sThePhoneVariable = $_POST["phone"];
$sTheCommentsVariable = $_POST["comments"];

echo"$sTheNameVariable$sTheEmailVariable$sThePhoneVariable$sTheCommentsVariable";
?>


<?php
$to = "jneslen@yahoo.com";
$subject = "Thanks for the comment";

$message = "Name: ";
$message .= "$name\r\n";
$message .= "E-Mail: ";
$message .= "$email\r\n";
$message .= "Comments:\r\n";
$message .= "$comments";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: Nectartech <dopehead@placma.com>\r\n";

mail($to,$subject,$message,$headers);

$sTheNameVariable = $_POST["name"];
$sTheEmailVariable = $_POST["email"];
$sTheCommentsVariable = $_POST["comments"];

echo"$sTheNameVariable$sTheEmailVariable$sTheCommentsVariable";
?>


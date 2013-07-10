<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>PHP Test</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
/* recipients */
$to  = "jneslen@yahoo.com" . ", " ; // note the comma
$to .= "jneflen@san.rr.com";

/* subject */
$subject = "Birthday Reminders for August";

/* message */
$message = '
<html>
<head>
 <title>Birthday Reminders for August</title>
</head>
<body>
<p>Here are the birthdays upcoming in August!</p>
<table>
 <tr>
  <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
 </tr>
 <tr>
  <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
 </tr>
 <tr>
  <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
 </tr>
</table>
</body>
</html>
';

/* To send HTML mail, you can set the Content-type header. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

/* additional headers */
$headers .= "From: Birthday Reminder <birthday@example.com>\r\n";

$headers .= "Cc: birthdayarchive@example.com\r\n";
$headers .= "Bcc: birthdaycheck@example.com\r\n";

/* and now mail it */
mail($to, $subject, $message, $headers);
?>

</body>
</html>

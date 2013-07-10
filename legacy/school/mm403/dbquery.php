<?php

$dataBaseName = "otigli_db";
$user = "otigli_ai1";
$password = "ai1";
$host = "bilimyolu.com";
$dbTable = "ai1_t1";

//connect to the database
$connect = mysql_connect($host, $user, $password);

//select the database to use
$dbSelect = mysql_select_db($dataBaseName, $connect);

if (!$connect){
return false;
exit;
}
if (!@mysql_select_db($dataBaseName)){
return false;
return $connect;
exit;
}

$query = "SELECT * FROM	$dbTable ORDER BY date DESC";

$result = mysql_query($query);

$information = "";

if ($result){

	while ($row = mysql_fetch_assoc($result)){
	$name = $row['name'];
	$email = $row['email'];
	$url = $row['url'];
	$message = $row['message'];
	$date = $row['date'];
	$ipAddress = $row['ipAddress'];

	$information = $information.
		"FROM: <b>$name</b> (message entered on $date using $ipAddress as and IP)".
		"<br>email: $email".
		"<br>URL: <a href='$url'>'$url'</a>".
		"<br>Message: $message".
		"<br>\n";
	
	}
}

if (!$result){
	echo "There was a problem retreiving your information";
	echo 
	exit;
	}
	
	echo "GBInfo=$information";
	
mysql_close();	


?>
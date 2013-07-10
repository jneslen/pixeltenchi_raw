<?php
require_once('database_connect.php');

/*initiate the variables past from flash*/
$timestamp = $_POST['time'];

/*connect to the db*/
$conn = db_connect();

 if (!$conn)
 {
 	$sDataConnect = "noconn";
	echo "sDataConnect=".$sDataConnect;
	exit;
 }
 else if($conn)
 {
	$sDataConnect = "connected";
	$numberOfEntries = mysql_query("select avg(feedback) from feedback where time >= '$timestamp'");
	$arrNumberOfEntries = mysql_fetch_array($numberOfEntries);
	$Average = each($arrNumberOfEntries);
	if (!$numberOfEntries)
	{
	$sDataConnect = "noentry";
	echo "sDataConnect=".$sDataConnect;
	exit;
	}
	
	echo "timestamp=".$timestamp."&average=".$Average['value']."&sDataConnect=".$sDataConnect;
 }
 //echo "sDataConnect=".$sDataConnect;
?>

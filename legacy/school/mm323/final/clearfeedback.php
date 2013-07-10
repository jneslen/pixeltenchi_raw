<?php
require_once('database_connect.php');

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
 	/*delete everything from the feedback table*/
 	$result = mysql_query("delete from feedback");
	$questionResult = mysql_query("delete from posts");
 	if (!$result || !$questionResult)
 	{
 	$sDataConnect = "fail";
 	echo "sDataConnect=".$sDataConnect;
 	mysql_close();
 	exit;
 	}
 	else
 	{
 	$sDataConnect = "success";
 	echo "sDataConnect=".$sDataConnect;
 	mysql_close();
 	exit;
 	}
}
 
?>
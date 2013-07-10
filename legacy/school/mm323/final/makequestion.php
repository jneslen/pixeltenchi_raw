<?php
require_once('database_connect.php');

$user = $_POST['user'];
$question = $_POST['question'];
/*Y-year m-month d-day H-hour i-min s-second for timestamp(14)*/
$timestamp = date('YmdHis');

/* Connecting, selecting database */
$conn = db_connect();

 if (!$conn)
 {
 	$sDataConnect = "noconn";
	echo "sDataConnect=".$sDataConnect;
	exit;
 }
 else if($conn)
 {
    /*make a query to get the user name's user id*/
	$useridNum = mysql_query("select userid from users where username='$user'");
	$arruseridNum = mysql_fetch_array($useridNum);
	$userID = extract ($arruseridNum);
	
	/*take userID, category, and time.. put it into a query to write all the information to feedback table*/
	$result = mysql_query("insert into posts set
							userid = '$userID',
							post = '$question',
							time = '$timestamp'");
							
	if (!result || !useridNum)
	{
	$sDataConnect = "fail";
	echo "sDataConnect=".$sDataConnect;
	mysql_close();
	exit;
	}
	/*if successfully written to db send success back to flash*/
	$sDataConnect = "success";
	echo "sDataConnect=".$sDataConnect;
	mysql_close();
	
 }
?>

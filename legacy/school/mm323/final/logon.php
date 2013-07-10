<?php
require_once('database_connect.php');

//create short variables from flash
$user = $_POST['user'];
$pass = $_POST['pass'];
$sOutput = "";
  if (!$user || !$pass)
  {
     $sOutput = "empty";
	 echo "sOutput=".$sOutput;
	 exit;
  }
  else if($user)
  {
  	$sOutput = "Good";
  }
/* Connecting, selecting database */
$conn = db_connect();

/*check if connected or not*/
 if (!$conn)
 {
 	$sDataConnect = "noconn";
	echo "sDataConnect=".$sDataConnect;
	exit;
 }
 else if($conn)
 {
 /*make a query for user and password*/
 	$sDataConnect = "Connected";	
	$result = mysql_query("select * from users 
							where username = '$user' 
							and password = '$pass'");
	/*get the catagories from the database to dynamically load them to flash*/						
	$catagories = mysql_query("select * from catagory where catagoryID = 1");
	$arrCatagories = mysql_fetch_array($catagories);
	extract($arrCatagories);
	
	if (!$result)
	{
		$sValid = "noContact";
		echo "sValid=".$sValid."&sDataConnect=".$sDataConnect;
		mysql_close();
		exit;
	}
	if (mysql_num_rows($result)>0)
	{
		$sValid = "valid";
		if (!$catagories){
		$sValid = "nocat";
		echo "sValid=".$sValid;
		mysql_close();
		exit;
		}
		echo "sValid=".$sValid."&sDataConnect=".$sDataConnect."&cat1=".$cat1."&cat2=".$cat2."&cat3=".$cat3."&cat4=".$cat4."&cat5=".$cat5;
		mysql_close();
		exit;
	}
	else
	{
		$sValid = "notValid";
		echo "sValid=".$sValid."&sDataConnect=".$sDataConnect;
		mysql_close();
		exit;
	}
	
	//$sDataConnect = "Connected";
	//echo "sDataConnect=".$sDataConnect;
	//exit;
 }
 
  //echo "sOutput=".$sOutput."&sDataConnect=".$sDataConnect;	


?>
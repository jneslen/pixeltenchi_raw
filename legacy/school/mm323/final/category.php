<?php
require_once('database_connect.php');

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
 /*make a query for categories*/
 	$sDataConnect = "Connected";
	$timestamp = date('YmdHis');
	$catagories = mysql_query("select * from catagory where catagoryID = 1");
	$arrCatagories = mysql_fetch_array($catagories);
	extract($arrCatagories);
	
	if (!$catagories)
	{
		$sValid = "noContact";
		echo "sValid=".$sValid."&sDataConnect=".$sDataConnect;
		mysql_close();
		exit;
	}
	else
	{
		echo "&cat1=".$cat1."&cat2=".$cat2."&cat3=".$cat3."&cat4=".$cat4."&cat5=".$cat5."&timestamp=".$timestamp;
		mysql_close();
	}
}

?>
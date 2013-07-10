<?php
require_once('database_connect.php');

$conn = db_connect();

if (!$conn)
 {
 	echo "didn't connect";
 }
if($conn)
{
	$catagories = mysql_query("select * from catagory where catagoryID = 1");
	$arrCatagories = mysql_fetch_array($catagories);
	extract($arrCatagories);
	echo "$cat1 $cat2 $cat3 $cat4 $cat5";
}

?>
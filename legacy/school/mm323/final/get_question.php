<?php
require_once('database_connect.php');

/*initiate the variables past from flash*/
$timestamp = date('YmdHis');
$user = $_POST['user'];
$question = $_POST['user'];
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
	$getAllCurrentPosts = mysql_query("select * from posts where time >= '$timestamp'-10");
	$arrAllPosts = mysql_fetch_array($getAllCurrentPosts);
	extract($arrAllPosts);
	/*this while loop is to test the variables put out by mySQL
	while ($element = each($reversAllPosts))
	{
	echo $element['key'];
	echo ' - ';
	echo $element['value'];
	echo '<br />';
	}
	*/
	$getUser = mysql_query("select * from users where userid = '$userid'");
	$arrGetUser = mysql_fetch_array($getUser);
	extract($arrGetUser);
	if ($question = $post)
	{
	$sDataConnect = "old";
	echo "sDataConnect=".$sDataConnect."&question=".$post."&user=".$username."&newq=".$question;
	exit;
	}
	else
	{
	$sDataConnect = "new";
	echo "sDataConnect=".$sDataConnect."&question=".$post."&user=".$username."&newq=".$question;
	}
	if (!$getAllCurrentPosts)
	{
	$sDataConnect = "noentry";
	echo "sDataConnect=".$sDataConnect;
	exit;
	}
	/*
	echo "timestamp=".$timestamp."&average=".$Average['value']."&sDataConnect=".$sDataConnect;
 */
 }
//echo "sDataConnect=".$sDataConnect.$allPosts;
?>

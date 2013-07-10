<?php

require_once('database_connect.php');

function registerNew($user, $password, $name, $email, $date)
//register the new user to the database
//return true or error message

{
//connect to database
$conn = db_connect();
if (!$conn)
	return 'Could Not Connect to Database';
	
//check if username is in use already or not
$result = mysql_query("select * from users where username='$user'");
if (!result)
{
	mysql_close();
	return 'Could not execute query';
}
if ( mysql_num_rows($result)>0)
{
	mysql_close();
	return 'That user name is taken, try again!';
}

//if ok so far, write to database
$result = mysql_query("insert into users set
						username='$user',
						password='$password',
						name='$name',
						email='$email',
						date='$date'");
if (!result)
{
	mysql_close();
	return 'Could not register you in the database!';
	
}
	return true;
	
	
}
						

?>
	
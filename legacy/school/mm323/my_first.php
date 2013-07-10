<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>PHP Test</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php echo "<p>Hello World</p>";
echo $_SERVER["HTTP_USER_AGENT"];
phpinfo();
if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")) {
	echo "You are using Internet Explorer<br />";
}
print "$PHP_SELF";

?>
</body>
</html>

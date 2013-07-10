<?php
// include function files for this application
   require_once('teaching_fns.php');
   require_once('register.php');

$createName = $_POST["name"];
$email = $_POST["email"];
$createUser = $_POST["user"];
$createPass = $_POST["pass"];
$verifyPass = $_POST["verify"];
$currentDate = date('Y-m-d');
//these variable will detrermine whe flash does
$sValidation = "bad"; 
$errorMsg = "Nothing Happened";	
	// start session which may be needed later
   	// start it now because it must go before headers
   	//session_start();
	
	// check forms filled in
   if (!valid_email($email))
   {
   $sValidation = "noemail";
   $errorMsg = "Not a Valid E-mail!";
   echo "&sValidation=".$sValidation."&errorMsg=".$errorMsg;
   exit;
   }
   
   /*write data to mySQL database user table*/
   $reg_result = registerNew($createUser, $createPass, $createName, $email, $currentDate);
   if ($reg_result === true)
   {
   		// register session variable
		$HTTP_SESSION_VARS['valid_user'] = $createUser;
		
		$sValidation = "good";
		$errorMsg = "Congratulations!";
		echo "&sValidation=".$sValidation."&errorMsg=".$errorMsg;
		exit;
	}
	else
	{
	$sValidation = "noDB";
	$errorMsg = $reg_result; //error message returned by register to be used in flash
	 echo "&sValidation=".$sValidation."&errorMsg=".$errorMsg;
	 exit;
	 }
  
	echo "&sValidation=".$sValidation."&errorMsg=".$errorMsg;
	

?>
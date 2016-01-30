<?php
$user = $_POST ['user'];
$pass = $_POST ['pass'];

include '../Model/db.php';

$retval = "error";

if (! $conn) 
{
	die ( 'Could not connect: ' . mysql_error () );
} 
else 
{	
	$sql = "select role from user WHERE user = '$user' AND password = '$pass'";
	
	mysql_select_db ( $mysql_database );
	
	$result = mysql_query ( $sql );
	
	if (! $result) 
	{
		die ( 'Unable to access data: ' . mysql_error () );
	} 
	else 
	{	
		if (mysql_num_rows ( $result ) == 1) 
		{
			$row = mysql_fetch_assoc($result);
			$role = $row["role"];
			$retval = "success";
		} 
	}
}

if ($retval == "success") 
{
	session_start();
	$_SESSION ["user"] = $user;
	$_SESSION ["role"] = $role;
}

echo $retval;

$name = "Lakshmi Traders";
$email = "dhana_sec@sify.com";
$title = "Login Detected";

$subject = $title;
$message = "\nYour website is assesed \n";
$header = "From:Lakshmi Traders \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail ( $email, $subject, $message, $header );

?>


<?php
session_start ();

include '../Model/db.php';

$retval = "auth";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{
	$retval = "error";
	
	$modelno = $_POST ["modelno"];
	$newmodelno = $_POST["newmodelno"];
	$brand = $_POST ["brand"];
	$size1 = $_POST ["size1"];
	$size2 = $_POST ["size2"];
	$hdtype = $_POST ["hdtype"];
	$type = $_POST ["type"];
	$god1 = $_POST ["god1"];
	$god2 = $_POST ["god2"];
	$pics = $_POST ["pics"];
	$make = $_POST ["make"];
	$color = $_POST ["color"];
	$date = $_POST ["date"];
	$price = $_POST ["price"];
		
	$sql = "UPDATE mainproduct SET modelno='$newmodelno',brand='$brand',size1='$size1',size2='$size2',hdtype='$hdtype',type='$type',stockgod1=stockgod1-(god1-'$god1'), stockgod2=stockgod2-(god2-'$god2'), god1='$god1', god2='$god2', pics='$pics',make='$make',color='$color',date='$date',price='$price' WHERE modelno='$modelno'";
			
	if (! $conn) 
	{
		die ( 'Could not connect: ' . mysql_error () );
	}
	else 
	{			
		mysql_select_db ( $mysql_database );
				
		$result = mysql_query ( $sql );
				
		if (! $result) 
		{
			die ( 'Could not enter data: ' . mysql_error () );
		} 
		else 
		{
			$retval = "success";
		}	
	}
}

echo $retval;
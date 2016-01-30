

<?php
session_start ();

include '../Model/db.php';

$retval = "auth";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{	
	$retval = "error";
	
	$modelno = $_POST ["modelno"];
	$adgod1 = $_POST ["adgod1"];
	$adgod2 = $_POST ["adgod2"];
	$date = $_POST ["rdate"];
	$price = $_POST ["price"];
		
	$sql = "UPDATE mainproduct SET god1=god1+'$adgod1',stockgod1=stockgod1+'$adgod1',god2=god2+'$adgod2',stockgod2=stockgod2+'$adgod2',date='$date',price='$price' WHERE modelno='$modelno'";
	
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
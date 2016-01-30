
<?php
session_start ();

include '../Model/db.php';
$retval = "auth";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1)) 
{	
	$retval = "error";
	
	$modelno = $_POST ["modelno"];
	$brand = $_POST ["brand"];
	$size1 = $_POST ["size1"];
	$size2 = $_POST ["size2"];
	$type = $_POST ["type"];
	$hdtype = $_POST ["hdtype"];
	$god1 = $_POST ["god1"];
	$god2 = $_POST ["god2"];
	$pics = $_POST ["pics"];
	$make = $_POST ["make"];
	$color = $_POST ["color"];
	$date = $_POST ["date"];
	$price = $_POST ["price"];
		
	$sql = "INSERT into mainproduct (modelno,brand,size1,size2,hdtype,type,god1,god2,stockgod1,stockgod2,pics,make,color,date,price) VALUES ('$modelno','$brand','$size1','$size2','$hdtype','$type','god1'+'$god1','god2'+'$god2','stockgod1'+'$god1','stockgod2'+'$god2','$pics','$make','$color','$date','$price')";
				
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
			$retval = "problem";
			die ( 'Could not enter data: ' . mysql_error () );
		} 
		else 
		{		
			$retval = "success";
		}		
	}
}


echo $retval;


?>

<?php
session_start ();

include '../Model/db.php';

$retval = "auth";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{	
	$retval = "error";
	
	$billno = $_POST ["billno"];
	$name = $_POST ["name"];
	$date = $_POST ["date"];
	$address = $_POST ["address"];
	$phone = $_POST ["phone"];
	$items = $_POST ["items"];
	$total = $_POST ["total"];
	$disc = $_POST ["disc"];
	$tax = $_POST ["tax"];
	$pay = $_POST ["pay"];
	$recvd = $_POST ["recvd"];
	$bal = $_POST ["bal"];
	
	$sql1 = "UPDATE bill SET name = '$name', date = '$date', address = '$address', phone='$phone',items='$items', total='$total', discount= '$disc', tax='$tax', payable='$pay', recvd='$recvd', balance='$bal' WHERE billno='$billno'";
	
	
	if (! $conn) 
	{
		die ( 'Could not connect: ' . mysql_error () );
	}
	else 
	{			
		mysql_select_db ( $mysql_database );
						
		$result = mysql_query ( $sql1 );
				
		
		if(!$result)
		{
			$retval = "rollback";
		}
		else 
		{	
			$retval = "success";		
		}
	}
}

echo $retval;
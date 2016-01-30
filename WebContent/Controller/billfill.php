<?php
session_start ();

include '../Model/db.php';

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{
	$billno = $_POST ["billno"];
	
	$result = "error";
	
	$sql = "SELECT * FROM bill WHERE billno = '$billno'";
	
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
			$row = mysql_fetch_array($result);
	
			$result = array('billno'=>$row['billno'],'date'=>$row['date'],'name'=>$row['name'],'address'=>$row['address'],'phone'=>$row['phone'],'items'=>$row['items'], 'total'=>$row['total'],'discount'=>$row['discount'],'tax'=>$row['tax'], 'payable'=>$row['payable'],'recvd'=>$row['recvd'], 'balance'=>$row['balance']);
		}
	
	}	
}

echo json_encode($result);
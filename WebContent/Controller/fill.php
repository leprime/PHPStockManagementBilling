

<?php
session_start ();

include '../Model/db.php';

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{
	$modelno = $_POST ["modelno"];
	
	$result = "error";
	
	$sql = "SELECT * FROM mainproduct WHERE modelno = '$modelno'";
	
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
				
			$result = array('modelno'=>$row['modelno'],'brand'=>$row['brand'],'size1'=>$row['size1'],'size2'=>$row['size2'],'hdtype'=>$row['hdtype'],'type'=>$row['type'],'god1'=>$row['god1'],'god2'=>$row['god2'],'pics'=>$row['pics'],'make'=>$row['make'],'color'=>$row['color'],'date'=>$row['date'],'price'=>$row['price']);
		}
	
	}	
}

echo json_encode($result);
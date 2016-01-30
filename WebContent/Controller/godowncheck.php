
<?php
session_start ();

include '../Model/db.php';

$display_string = array('exist'=>'auth');

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{		
	$display_string = array('exist'=>'error');
	
	$modelno = $_POST ["modelno"];
		
	$sql = "SELECT * FROM mainproduct WHERE modelno = '$modelno'";

	if (! $conn) 
	{
		die ( 'Could not connect: ' . mysql_error () );
	}
	else 
	{				
		$display_string = array('exist'=>'no');
		
		mysql_select_db ( $mysql_database );

		$result = mysql_query ( $sql );
		
		if (! $result) 
		{
			die ( 'Could not enter data: ' . mysql_error () );
		} 
		else 
		{
			
			if($row = mysql_fetch_array($result))
			{
				$display_string = array('stockgod1'=>$row['stockgod1'],'stockgod2'=>$row['stockgod2'],'price'=>$row['price'],'exist'=>'yes');
			}
			

		}
	}
}

echo json_encode($display_string);
?>
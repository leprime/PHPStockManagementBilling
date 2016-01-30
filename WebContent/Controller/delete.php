
<?php
session_start ();

$display_string = "auth";
if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{
	include '../Model/db.php';

	$sql = $_POST ["sql"];
	
	$sql = str_replace("\'", "'", $sql);
	
	$display_string = "error";

	if (! $conn)
	{
		die ( 'Could not connect: ' . mysql_error () );
	}
	else
	{
			
		mysql_select_db ( $mysql_database );
	
		$sqlar = explode(";",$sql);
		
		foreach ($sqlar as $sq)
		{
			$sq = trim($sq);
			
			if($sq == null)
			{
				
			}
			else 
			{
				$result = mysql_query ( $sq );
				
				if (! $result)
				{
					die ( 'Could not enter data: ' . mysql_error () );
				}
				else
				{
					$display_string = "success";
				}
			}
		}
		
	}
}

echo $display_string;

?>
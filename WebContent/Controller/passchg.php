
<?php
session_start ();

$display_string = "auth";
if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{
	include '../Model/db.php';

	$sql = urldecode($_POST ["sql"]);
	$sql = str_replace("\'", "'", $sql);
	$sql = str_replace("#", "+", $sql);
	
	$display_string = "error";

	if (! $conn)
	{
		die ( 'Could not connect: ' . mysql_error () );
	}
	else
	{
			
		mysql_select_db ( $mysql_database );
		
		$sqlar = explode(";",$sql);
		
		$done = "true";
		
		foreach ($sqlar as $sq)
		{
			$sq = trim($sq);
			
			if($sq == null)
			{
				$done = "false";
			}
			else 
			{
				$result = mysql_query ( $sq );
				if (! $result)
				{
					$done = "false";
					die ( 'Could not enter data: ' . $sq );
				}
			}
		}
		
		if($done == "false")
		{
			mysql_query('COMMIT');
			$display_string = "success";
		}
		else
		{
			mysql_query("ROLLBACK");
			$display_string = "rollback";
		}
		
	}
}

echo $display_string;

?>
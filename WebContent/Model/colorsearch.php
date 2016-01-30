<?php

include 'db.php';

if (isset($_GET['term']))
{
	$con=mysql_connect($mysql_host, $mysql_user, $mysql_password) or die("Failed to connect to MySQL: " . mysql_error());
	$db=mysql_select_db($mysql_database,$con) or die("Failed to connect to MySQL: " . mysql_error());
    	
  	$result = mysql_query("SELECT color FROM mainproduct WHERE color LIKE '".($_GET['term'])."%'");
        
	$data = array();
	
	while ($row = mysql_fetch_array($result)) 
	{
		array_push($data, $row['color']);	
	}	
	echo json_encode($data);

}

?>
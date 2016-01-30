<?php
session_start ();

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{

	include 'db.php';

	$sql = "CREATE TABLE IF NOT EXISTS ( `sno` int( 20 ) NOT NULL AUTO_INCREMENT ,
`modelno` varchar( 15 ) NOT NULL ,
`brand` varchar( 15 ) NOT NULL ,
`size1` int( 4 ) unsigned NOT NULL ,
`size2` int( 4 ) unsigned NOT NULL ,
`hdtype` varchar( 20 ) NOT NULL ,
`type` varchar( 10 ) NOT NULL ,
`god1` int( 7 ) unsigned NOT NULL ,
`god2` int( 7 ) unsigned NOT NULL ,
`stockgod1` int( 7 ) unsigned NOT NULL ,
`stockgod2` int( 7 ) unsigned NOT NULL ,
`salegod1` int( 7 ) unsigned NOT NULL ,
`salegod2` int( 7 ) unsigned NOT NULL ,
`pics` int( 5 ) unsigned NOT NULL ,
`make` varchar( 10 ) NOT NULL ,
`color` varchar( 10 ) NOT NULL ,
`date` date NOT NULL ,
`price` int( 10 ) unsigned NOT NULL ,
`image` longblob,
PRIMARY KEY ( `sno` ) ,
UNIQUE KEY `modelno` ( `modelno` ) ) ENGINE = InnoDB DEFAULT CHARSET = latin1;";
	
	$sql2 = "CREATE TABLE IF NOT EXISTS `bill` (
`billno` varchar( 20 ) NOT NULL ,
`date` varchar( 12 ) NOT NULL ,
`name` varchar( 50 ) NOT NULL ,
`address` varchar( 200 ) NOT NULL ,
`phone` int( 12 ) NOT NULL ,
`items` varchar( 10000 ) NOT NULL ,
`total` int( 10 ) unsigned NOT NULL ,
`discount` int( 3 ) unsigned NOT NULL ,
`tax` int( 3 ) unsigned NOT NULL ,
`payable` int( 10 ) unsigned NOT NULL ,
`recvd` int( 10 ) unsigned NOT NULL ,
`balance` int( 10 ) unsigned NOT NULL ,
UNIQUE KEY `billno` ( `billno` )
) ENGINE = InnoDB DEFAULT CHARSET = latin1;";
	
	$sql3 = "CREATE TABLE IF NOT EXISTS `user` (
`user` varchar( 20 ) NOT NULL ,
`password` varchar( 20 ) NOT NULL ,
`role` int( 1 ) NOT NULL ,
PRIMARY KEY ( `user` )
) ENGINE = InnoDB DEFAULT CHARSET = latin1;";
	
	$sql4 = "INSERT INTO `user` (`user`, `password`, `role`) VALUES ('admin', 'admin123', '2');";
	
	if (! $conn)
	{
		die ( 'Could not connect: ' . mysql_error () );
	}
	else
	{
		mysql_select_db ( $mysql_database );
	
		$result = mysql_query ( $sql );
		$result2 = mysql_query ( $sql2 );
		$result3 = mysql_query ( $sql3 );
		$result4 = mysql_query ($sql4 );	
	}
	
	echo $result;
	echo $result2;
	echo $result3;
	echo $result4;
}
else
{
	
	echo "hii";
}

?>

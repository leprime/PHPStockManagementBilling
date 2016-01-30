<?php
session_start ();

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{
	$modelno = $_GET ["modelno"];
	
	include 'Model/db.php';

	$sql = "SELECT * FROM mainproduct WHERE modelno = '$modelno'";

	mysql_select_db ( $mysql_database );

	$result = mysql_query ( $sql );

	if (! $result) 
	{
		$display_string = "problem";
		die ( 'Could not enter data: ' . mysql_error () );
	}
	else
	{
		$row = mysql_fetch_array($result);
	}

?>

	<html>
	<head>
	<title>Lakshmi Traders | product</title>
	<link rel="stylesheet" type="text/css" href="View/CSS/common.css">
	<link rel="stylesheet" type="text/css" href="View/CSS/format.css">
	<link rel="stylesheet" type="text/css" href="View/CSS/common.css">
	<link rel="stylesheet" type="text/css" href="View/CSS/topnav.css">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
	<script src="View/Script/common.js"></script>
	<script type="text/javascript">
	


	</script>
	</head>
	<body bgcolor="#eee" background="View/resource/bg2.jpg">

	<body>
	<div style="background-color: yellow;">
		<h1 style="font-size: 500%">
			<center><a href="admin.php" style="">Lakshmi Traders</a></center>
		</h1>
	</div>
	<div style="background-color: brown;">
		<h1 style="font-size: 200%">
			<center>Stock Details</center>
		</h1>
	</div>

	<div>
	<nav id="topnav">
			<!--  <a href="" ><img src="prasilabs.png" width="7%" height="5%;" /></a> -->
			<n>
					<a href="admin.php" id="navbtn">HOME</a>
	<?php if($_SESSION["role"] > 1)
		{
	?>
		<a href="addProduct.php" id="navbtn">PRODUCT</a>
		<a href="edit.php" id="navbtn">EDIT</a>
		<a href="mis.php" id="navbtn">MIS</a>
	<?php }?>
		<a href="search.php" id="navbtn">SEARCH</a>
		<a href="billing.php" id="navbtn">BILLING</a>
			</n>
		</nav>
	
	
	</div>
	
	<div>
		<table border=1 style='width:100%'>
			
			<tbody>
				<tr><td>Model NO</td><td><?php echo $row[modelno] ?></td></tr>
				<tr><td>BRAND</td><td><?php echo $row[brand] ?></td></tr>
				<tr><td>SIZE</td><td><?php echo "$row[size1] x $row[size2]" ?></td></tr>
				<tr><td>TYPE</td><td><?php echo $row[type] ?></td></tr>
				<tr><td><table border=1 style='width:100%'><td>QTY</td><td><?php echo $row[qty] ?></td></table></td><td><table border=1 style='width:100%'><td>PICS</td><td><?php echo $row[pics] ?></td></table></td></tr>
				<tr><td><table border=1 style='width:100%'><td>STOCK</td><td><?php echo $row[stock] ?></td></table></td><td><table border=1 style='width:100%'><td>SALE</td><td><?php echo $row[sale] ?></td></table></td></tr>
				<tr><td>MAKE</td><td><?php echo $row[make] ?></td></tr>
				<tr><td>color</td><td><?php echo $row[color] ?></td></tr>
				<tr><td>Recieved Date</td><td><?php echo $row[date] ?></td></tr>
				<tr><td>PRICE</td><td><?php echo $row[rprice] ?></td></tr>
				<tr><td>SELLING PRICE</td><td><?php echo $row[sprice] ?></td></tr>
			</tbody>
		</table>
	
	
	</div>
	
	





	</body>
	</html>

<?php 
	
}	
else
{
	header('Location: admin.php');
	
}
?>
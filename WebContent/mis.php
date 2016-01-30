<?php
	session_start();
if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{

?>

<html>
<head>
<title>Lakshmi Traders | MIS</title>
<link rel="stylesheet" type="text/css" href="View/CSS/topnav.css">
<link rel="stylesheet" type="text/css" href="View/CSS/table.css">
<link rel="stylesheet" type="text/css" href="View/CSS/common.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src="View/Script/ajax.js"></script>
<script src="View/Script/productmanager.js"></script>
<script src="View/Script/tablesorter.js"></script>
<script src="View/Script/response.js"></script>

</head>

<body bgcolor="#eee" background="View/resource/bg2.jpg">
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
		<a href="mis.php" id="navbtn" style="background-color: red">MIS</a>
	<?php }?>
		<a href="search.php" id="navbtn">SEARCH</a>
		<a href="billing.php" id="navbtn">BILLING</a>
			</n>
		</nav>
	
	
	</div>


<div style="background-color: yellow;">
		<h1 style="font-size: 500%">
			<center><a href="admin.php" style="">Lakshmi Traders</a></center>
		</h1>

	</div>
	<div style="background-color: brown;">
		<h1 style="font-size: 200%">
			<center>MIS GENERATOR</center>
		</h1>
	</div>
	
		
	
	
	<img alt=""  id="ajldr" style="display: none;" src="View/resource/ajax-loader.gif">
	<form onsubmit="mis(); return false;" style="padding-left: 20%; padding-right: 20%;" >
	<p id="choice">
	<label>Choice</label>
		<input type="radio" id="all" name="radio" checked="checked"><label for="all">ALL</label>
		<input type="radio" id="stock" name="radio"><label for="stock">STOCK</label>
		<input type="radio" id="sale" name="radio"><label for="sale">SALE</label>
	</p><br><br>
	<p>
	<label>FROM </label><input type="date" id="fdate" readonly="readonly" style="background: white;"> To <input type="date" id="tdate" readonly="readonly" style="background: white;">
	</p>
	<p>
	<label>Model No</label><input type="text" id="modelno"><br>
	</p>
	<p>
	<label>Brand Name</label><input type="text" id="brand"><br>
	</p>
	<p>
	<label>Type</label>
	<select id="type">
			<option name="" value=""></option>
			<option name="virtified" value="virtified">Vitrified</option>
			<option name="Wall" value="Wall" >Wall</option>
			<option name="floor" value="floor">Floor</option>
			<option name="parking" value="parking">Digital</option>
	</select>
	</p>
	<p>
		<button type="submit">Search</button>
	</p>
	</form>
	
	
	<div id="result"> Result </div>
	
	</body>
	</html>
	
	<?php 

	}
	else 
	{
		header('Location: admin.php');
		
	}


?>
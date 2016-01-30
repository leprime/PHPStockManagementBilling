<?php
session_start ();
if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{
	

?>
<html>
<head>
<title>Lakshmi Traders | Add product</title>
<link rel="stylesheet" type="text/css" href="View/CSS/common.css">
<link rel="stylesheet" type="text/css" href="View/CSS/topnav.css">
<link rel="stylesheet" type="text/css" href="View/CSS/table.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

<script src="View/Script/tablesorter.js"></script>
<script src="View/Script/productmanager.js"></script>
<script src="View/Script/billmanager.js"></script>
<script src="View/Script/ajax.js"></script>

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
		<a href="mis.php" id="navbtn">MIS</a>
	<?php }?>
		<a href="search.php" id="navbtn" style="background-color: red">SEARCH</a>
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
		<center>SEARCH</center>
	</h1>
</div>
		
<div id="dialog-confirm"></div>
		
<div style="padding-right: 25%; padding-left: 25%">
	<img alt=""  id="ajldr" style="display: none;" src="View/resource/ajax-loader.gif" />
	
	<p id="choice">
		<input type="radio" id="stock" name="radio" checked="checked" onclick="$('#searchform' ).show( 400 );$('#billform' ).hide( 400 );"><label for="stock">STOCK</label>
		<input type="radio" id="bill" name="radio" onclick="$('#billform' ).show( 400 );$('#searchform' ).hide( 400 );"><label for="bill">BILL</label>
	</p>
	
	<form id="searchform" onsubmit="searchprod(0); return false;">
	<p>
		<label>Model No</label><input type="text" id="modelno">
	</p>
			
	<p>
		<label>Brand Name</label><input type="text" id="brand" size="5">
	</p>

	<p>
		<label>Size </label><input type="number" id="size1" min="1" maxlength="2" style="width: 10%;" > x <input type="number"  id="size2" size="2" min="1" style="width: 10%;">
	</p>

	<p>
		<label>Type </label><select id="type">
		<option value=""></option>
		<option value="floor">Floor</option>
		<option value="parking">Parking</option>
		<option value="vitrified">Vitrified</option>
		<option value="wall">Wall</option>
		</select>
	</p>
	
	<p>
		<label>Make </label><select id="make">
		<option value=""></option>
		<option value="indian">Indian</option>
		<option value="imported">Imported</option>
		</select>
	</p>

	<p>
		<label>colour </label><input type="text" id="color" size="8">
	</p>

	<p>
		<label>Recieved Date </label> <input type="date" id="fdate" readonly="readonly" size="6" style="background: white;"> TO <input type="text" id="tdate" readonly="readonly" size="6" style="background: white;">
	</p>

	<p>
		<label for="amount">Price range:</label>
		<input type="text" id="prodamount" readonly style="border:0; color:#f6931f; font-weight:bold;">
	</p>

	<div id="prodpriceslider"></div>
	<p>
		<button type="submit">SEARCH</button> <button type="reset">reset</button>
	</p>

	</form>
	
	<form id="billform" style="display: none;" onsubmit="searchbill(0); return false;">
	<p>
		<label>Bill No</label><input type="text" id="billno">
	</p>
			
	<p>
		<label>Person Name</label><input type="text" id="name" size="5">
	</p>

	<p>
		<label>Model No</label><input type="text" id="billmodelno" size="5">
	</p>
	
	<p>
		<label>Recieved Date </label> <input type="date" id="fdate" readonly="readonly" size="6" style="background: white;"> TO <input type="text" id="tdate" readonly="readonly" size="6" style="background: white;">
	</p>

	<p>
		<label for="billamount">Price range:</label>
		<input type="text" id="billamount" readonly style="border:0; color:#f6931f; font-weight:bold;">
	</p>

	<div id="billpriceslider"></div>
	<p>
		<button type="submit">SEARCH</button> <button type="reset">reset</button>
	</p>
	</form>
	
</div>

<div id="result">  </div>
	
</body>
</html>

<?php 

	}
	else 
	{
		header('Location: admin.php');
		
	}


?>
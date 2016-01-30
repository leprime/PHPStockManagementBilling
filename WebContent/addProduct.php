<?php
session_start ();

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
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
	<script src="View/Script/ajax.js"></script>
	<script src="View/Script/productmanager.js"></script>
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
		<a href="addProduct.php" id="navbtn" style="background-color: red">PRODUCT</a>
		<a href="edit.php" id="navbtn">EDIT</a>
		<a href="mis.php" id="navbtn">MIS</a>
	<?php }?>
		<a href="search.php" id="navbtn">SEARCH</a>
		<a href="billing.php" id="navbtn">BILLING</a>
			</n>
		</nav>
	</div>
	
	<br>
	
	<div style="background-color: yellow;">
		<h1 style="font-size: 500%">
			<center><a href="admin.php" style="">Lakshmi Traders</a></center>
		</h1>
	</div>
	<div style="background-color: brown;">
		<h1 style="font-size: 200%">
			<center>PRODUCT</center>
		</h1>
	</div>
		
	<p id="existmsg" style="display: none; background-color: red; color: blue">Product Exist</p>
	<p id="addmsg" style="display: none; background-color: green; color: red;">Succesfully Added</p>
	
	<img alt=""  id="ajldr" style="display: none;" src="View/resource/ajax-loader.gif" />
	
	
	<div id="prod" style="padding-left: 5%;padding-right: 5%;">
	<form onsubmit="add(); return false;">
	<table border = 1 style="width: 100%;"> 
		<th colspan="6" bgcolor="yellow">Model Details</th>
		<tr>
			<td bgcolor="grey">	Model No</td><td><input type="text" id="modelno" required="required" onblur="go();"  pattern="[a-zA-Z0-9]{3}"/></td>
			<td bgcolor="grey">Brand Name</td><td><input id="brand" type="text" required="required" /></td>
			<td bgcolor="grey">Date</td><td><input id="date" type="text" readonly="readonly" required="required" style="background: white;"/></td>
		</tr>
		<tr>
			<td bgcolor="grey">Size</td><td><input id="size1" style="width: 40%" type="number" required="required"/>x<input id="size2" type="number" required="required"/></td>
			<td bgcolor="grey">Category</td>
			<td><select id="type" style="width: 30%;">
					<option value="floor">Floor</option>
					<option value="parking">Parking</option>
					<option value="vitrified">Vitrified</option>
					<option value="wall">Wall</option>
				</select>
				<select id="floortype" style="display: none;">
					<option value="digital">Digital</option>
					<option value="antiskit">Anti Skit</option>
					<option value="ordinary">Ordinary</option>
				</select>
				<select id="parkingtype" style="display: none;">
					<option value="digital">Digital</option>
					<option value="ordinary">Ordinary</option>
				</select>
				<select id="vitrifiedtype" style="display: none;">
					<option value="nano">Nano</option>
					<option value="ordinary">Ordinary</option>
					<option value="doublecharge">Double Charge</option>
					<option value="gvt">GVT</option>
					<option value="pgvt">PGVT</option>
					<option value="solublesalt">Soluble Salt</option>
				</select>
				<select id="walltype" style="display: none;">
					<option value="digital">Digital</option>
					<option value="ordinary">Ordinary</option>
				</select>
				<select id="make" >
					<option value="indian">indian</option>
					<option value="imported">imported</option>
				</select></td>
				<td bgcolor="grey">Color</td><td><input id="color" type="text" required="required"/></td>
		</tr>
		<th colspan="6" bgcolor="yellow">Model Details</th>
		<tr>
			<td bgcolor="grey">QTY</td><td><input id="god1" type="number" placeholder="Godown 1" required="required"/><i class="add" style="display:none;">+<input id="adgod1" type="number" placeholder="godown1" /></i><br><input id="god2" type="number" placeholder="Godown 2" required="required"/><i class="add" style="display:none;">+<input id="adgod2" type="number" placeholder="godown2"/></i></td>
			<td bgcolor="grey">PICS</td><td><input id="pics" type="text" required="required"/></td>
			<td bgcolor="grey">Price</td><td><input id="price" type="number" required="required"/></td>
		</tr>
		<th colspan="6" bgcolor="yellow" onclick="showimage();">Image</th>
		<tr id="image" style="display: none;">
			<td bgcolor="grey">Photo 1</td><td><input id="image1" type="file"/></td><td bgcolor="grey">Photo 2</td><td><input id="image2" type="file"/></td><td bgcolor="grey">Photo 3</td><td><input id="image3" type="file"/></td>
		</tr>
		<p>
			<button type="submit">ADD</button><button id="edbtn" onclick='gotoeditpage();' type="button" style="display: none;">EDIT</button><button onclick="rest()" type="reset" >Reset</button>
		</p>
		</table>
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
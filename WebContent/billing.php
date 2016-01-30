<?php
session_start();
if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{

	$modelno = $_GET ["modelno"];

?>
<html>

<head>
<title>Lakshmi Traders | Billing</title>
<link rel="stylesheet" type="text/css" href="View/CSS/topnav.css">
<link rel="stylesheet" type="text/css" href="View/CSS/table.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

<script src="View/Script/tablesorter.js"></script>
<script src="View/Script/billmanager.js"></script>
<script src="View/Script/ajax.js"></script>

<script type="text/javascript">
	function printphp()
	{
		var billno = document.getElementById("billno").value;
		window.location = "print.php?billno"+billno;
	}
</script>
</head>

<body bgcolor="#eee" background="View/resource/bg2.jpg">
<div style="background-color: yellow;">
	<h1 style="font-size: 500%">
		<center><a href="admin.php" style="">Lakshmi Traders</a></center>
	</h1>
</div>

<div style="background-color: brown;">
	<h1 style="font-size: 200%">
		<center>Billing</center>
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
		<a href="billing.php" id="navbtn" style="background-color: red">BILLING</a>
		</n>
	</nav>	
</div>

<form onsubmit="addbill(); return false;">
	<table border = 1 style="width: 100%;">
	<th colspan="6" bgcolor="yellow">Bill Details</th>
	<tr>
	<td bgcolor="grey">Bill No</td><td><input type="text" id="billno" required="required" onclick="reloadbillno()" value="<?php echo date("Y/m/d").substr( md5(rand()), 0, 4);?>" readonly="readonly"></button></td>
	<td bgcolor="grey">Date</td><td><input type="text" id="date" required="required" value="<?php echo date("Y-m-d")?>"></td>
	</tr>
	<tr>
	<td bgcolor="grey">Name</td><td><input type="text" id="name" pattern="[a-zA-Z][a-zA-Z ]{4,}" required="required"></td>
	<td bgcolor="grey">Address</td><td><input type="text" id="address"></td>
	<td bgcolor="grey">Phone</td><td><input type="tel" pattern="[0-9]{5,10}" id="phone"></td>
	</tr>
	<th colspan="6" bgcolor="yellow">Product Details</th>
	<tr class="items">
	<td bgcolor="grey">Modelno</td><td><input value="<?php echo $modelno?>" type="text" class = "modelno" required="required"></td>
	<td bgcolor="grey">No of Box</td><td><select class="god"><option value="1">Godown 1</option><option value="2">Godown 2</option></select><input type="number" required="required" placeholder="qty" class="qty"><label>X</label><input type="number" class="sprice" placeholder="price per box"/></td>
	<td bgcolor="grey">Price</td><td><input type="number" required="required" readonly="readonly" class="price"><button type="button" id="addrow" style="float: right;">+</button></td>
	</tr>
	<th colspan="6" bgcolor="yellow">Amount</th>
	<tr>
	<td bgcolor="grey">Total</td><td><input type="number" required="required" id="total" readonly="readonly"></td>
	<td bgcolor="grey">Discount</td><td><input type="number" required="required" value="0" id="discount" class="calc"></td>
	<td bgcolor="grey">Tax</td><td><input type="number" required="required" value="0" id="tax" class="calc"></td>
	</tr>
	<tr>
	<td bgcolor="grey">Payable</td><td><input type="number" required="required" id="payable" readonly="readonly"></td>
	<td bgcolor="grey">Recieved</td><td><input type="number" required="required" value="0" id="recvd" class="calc"></td>
	<td bgcolor="grey">Balance</td><td><input type="number" required="required" id="balance" readonly="readonly"></td>
	</tr>
	</table>
	<p>
	<button type="Reset">Reset</button>
	<button id="submit" type="submit">Process</button>
	<button id="print" type="button" onclick="printphp();">Print</button>
	</p>
</form>


</body>
</html>


<?php 

}
else
{
	header('Location: admin.php');
		
}


?>



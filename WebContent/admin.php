<?php
session_start ();

?>
<html>
<head>
<title>Laskshmi Traders</title>
<link rel="stylesheet" type="text/css" href="View/CSS/common.css">
<link rel="stylesheet" type="text/css" href="View/CSS/topnav.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src = "View/Script/usermanager.js"></script>

<script type="text/javascript">
$(function() {
$( "#rmenu" ).menu();
$( "#dialog" ).dialog();
});

</script>

</script>


</head>
<body bgcolor="#eee" background="View/resource/bg2.jpg">

<div style="background-color: yellow;">
	<h1 style="font-size: 500%">
	<center>Lakshmi Traders</center>
	</h1>
</div>

<div style="background-color: brown;">
	<h1 style="font-size: 200%">
	<center>Welcome to Inventory Management</center>
	</h1>
</div>
	
<img alt=""  id="ajldr" style="display: none;" src="View/resource/ajax-loader.gif" />
	
<?php
if (isset ( $_SESSION ["user"] )) 
{
?>
<div>
	<nav id="topnav">
	<!--  <a href="" ><img src="prasilabs.png" width="7%" height="5%;" /></a> -->
	<n>
		<a href="admin.php" id="navbtn" style="background-color: red">HOME</a>
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

<div style="float: right;">
	<?php echo "Welcome ".$_SESSION["user"]."!"?><br>
	<a href="logout.php">Logout</a><br><br>
	<?php 
		if($_SESSION["role"] == 2)
		{
	?>
							
<div>			
	<ul id = "rmenu">
		<li class="ui-state-disabled">Admin Panel</li>
		<li onclick="location.href='adminpanel.php'">User Management</li>	
	</ul>
			
</div>
	
			
<?php 
	}
?>
				
</div>
			
<?php
} 
else 
{
?>

<form onsubmit="logn(); return false;">
	username<input type="text" pattern="[a-z]{4,10}" id="user"> <br> <br> 
	Password<input type="password" id="pass"> <br> <br>
	<button name="login" type="submit">Login</button>
	<a href="email.php" onclick="">Forgot Password</a>
</form>

<?php
}
?>
	
</body>
</html>
<?php
?>
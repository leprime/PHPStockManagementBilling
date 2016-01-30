<?php
session_start ();
if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{
	include 'Model/db.php';
	
	$sql = "SELECT * FROM user WHERE 1";
	
	$msg = "";
	
	$user = array();
	$pass = array();
	$role = array();

	?>
	
	<html>
	<head>
	<head>
	<title>Lakshmi Traders | Admin Panel</title>

	<link rel="stylesheet" type="text/css" href="View/CSS/common.css">
	<link rel="stylesheet" type="text/css" href="View/CSS/topnav.css">
	<link rel="stylesheet" type="text/css" href="View/CSS/table.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
	<link rel="shortcut icon" href="View/resource/favicon.ico" type="image/x-icon">
	<link rel="icon" href="View/resource/favicon.ico" type="image/x-icon">

	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">

	function passchg()
	{
		var olduser = [];
		var user = [];
		var pass = [];

		olduser[1] = $('#olduser1').val();
		user[1] = $('#user1').val();
		pass[1] = $('#pass1').val();
		olduser[2] = $('#olduser2').val();
		user[2] = $('#user2').val();
		pass[2] = $('#pass2').val();

		var sql = "UPDATE `user` SET `user` = '"+user[1]+"', `password`= '"+pass[1]+"' WHERE `user` = '"+olduser[1]+"';";
		sql += "UPDATE `user` SET `user` = '"+user[2]+"', `password`= '"+pass[2]+"' WHERE `user` = '"+olduser[2]+"';";

		var vars = "sql="+sql;

		var hr = new XMLHttpRequest();
		var url = "Controller/passchg.php";
		hr.open("POST", url, true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() 
		{
			console.log(hr);
		    if(hr.readyState == 4 && hr.status == 200) 
			{
		    	var rdata = hr.responseText;
		    	$("#ajldr").hide( 100 );
				if(rdata.trim() == "success")
				{
					alert("Success");
					location.reload();
				}
				else
				{
					alert("Error");
				}				
			}
		};
		hr.send(vars);			
	}
	</script>
	</head>
	<body bgcolor="#eee" background="View/resource/bg2.jpg">
	
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


<div style="background-color: yellow;">
	<h1 style="font-size: 500%">
	<center>Lakshmi Traders</center>
	</h1>
</div>

<div style="background-color: brown;">
	<h1 style="font-size: 200%">
	<center>Admin Panel</center>
	</h1>
</div>
		
<div id="dialog-confirm"></div>
		
<div>
	<img alt=""  id="ajldr" style="display: none;" src="View/resource/ajax-loader.gif" />
	
	
	
	
	<?php 
	
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
			
			$i = 1;
			while($row = mysql_fetch_array($result))
			{
				$user[$i] = $row['user'];
				$pass[$i] = $row['password'];
				$role[$i] = $row['role'];
				
				$i = $i + 1;
			}
			
			
			$msg = "<table border=1 style='width:50%'>";
			$msg .= "<thead>";
			$msg .= "<tr>";
			$msg .= "<th><span>S.no</span></th>";
			$msg .= "<th><span>old username</span></th>";
			$msg .= "<th><span>username</span></th>";
			$msg .= "<th><span>password</span></th>";
			$msg .= "<th><span>role</span></th>";
			$msg .= "</tr>";
			$msg .= "</thead>";
			$msg .= "<tbody>";
			$msg .= "<form onsubmit='passchg(); return false;'>";
			
			for($j = 1; $j < $i; $j++)
			{
				$msg .= "<tr>";
				$msg .= "<td>$j</td>";
				$msg .= "<td><input id='olduser$j' requred='required' disabled='disabled' value='$user[$j]' /></td>";
				$msg .= "<td><input id='user$j' pattern='[a-z]{4,10}' requred='required' value='$user[$j]' /></td>";
				$msg .= "<td><input id='pass$j' requred='required' value='$pass[$j]' /></td>";
				if($role[$j] == 2)
				{
					$role[$j] = "admin";
				}
				else
				{
					$role[$j] = "user";
				}
				$msg .= "<td><input class='role' disabled='disabled' value='$role[$j]' /></td>";
				$msg .= "</tr>";
			}
			$msg .= "</tbody>";
			$msg .= "</table>";
			$msg .= "<br>";
			$msg .= "<button type='submit'>Change</button>";
			$msg .= "</form>";
		}
	
		echo $msg;
	
	
	}
?>
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
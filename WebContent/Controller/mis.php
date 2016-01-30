
<?php
session_start ();

include '../Model/db.php';

$display_string = "problem";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 1))
{	
	$mode = $_POST ["mode"];
	$modelno = $_POST ["modelno"];
	$brand = $_POST ["brand"];
	$hdtype = $_POST ["hdtype"];
	$fdate = $_POST ["fdate"];
	$tdate = $_POST ["tdate"];
		
	$sql = "SELECT * FROM mainproduct WHERE modelno LIKE '$modelno%' AND brand LIKE '$brand%'";
	
	$sql .= "AND hdtype LIKE '$hdtype%' ";

	if(!($fdate == "" || $tdate == "" ))
	{
		$sql .= "AND date between '$fdate' AND '$tdate' ";
	}
	
	
	$display_string = "problem";
	if (! $conn) 
	{
		$display_string = "problem";
		die ( 'Could not connect: ' . mysql_error () );
	}
	else 
	{		
			
		mysql_select_db ( $mysql_database );
		
		$result = mysql_query ( $sql );
		
		if (! $result) 
		{
			$display_string = "problem";
			die ( 'Could not enter data: ' . mysql_error () );
		} 
		else 
		{
			if($mode == 1)
			{
				$display_string = "<button type = 'button' onclick='del()'>Delete</button>";
				$display_string .= "<table id='searchresult' border=1 style='width:100%'>";
				$display_string .= "<thead>";
				$display_string .= "<tr>";
				$display_string .= "<th><span>S.no</span></th>";
				$display_string .= "<th><span>Model No</span></th>";
				$display_string .= "<th><span>Brand</span></th>";
				$display_string .= "<th><span>size</span></th>";
				$display_string .= "<th><span>type</span></th>";
				$display_string .= "<th><span>Sub-type</span></th>";
				$display_string .= "<th colspan='2'><span>STOCK</span></th>";
				$display_string .= "<th><span>pics</span></th>";
				$display_string .= "<th><span>make</span></th>";
				$display_string .= "<th><span>color</span></th>";
				$display_string .= "<th><span>Date</span></th>";
				$display_string .= "<th><span>Price</span></th>";
				$display_string .= "</tr>";
				$display_string .= "</thead>";
				$display_string .= "<tbody>";
				
				$i = 1;
			
				while($row = mysql_fetch_array($result))
				{
					$display_string .= "<tr>";
					$display_string .= "<td>$i</td>";
					$display_string .= "<td><a href='details.php?modelno=$row[modelno]';>$row[modelno]</a></td>";
					$display_string .= "<td>$row[brand]</td>";
					$display_string .= "<td>$row[size1] x $row[size2]</td>";
					$display_string .= "<td>$row[hdtype]</td>";
					$display_string .= "<td>$row[type]</td>";
					$display_string .= "<td>$row[stockgod1]</td>";
					$display_string .= "<td>$row[stockgod2]</td>";
					$display_string .= "<td>$row[pics]</td>";
					$display_string .= "<td>$row[make]</td>";
					$display_string .= "<td>$row[color]</td>";
					$display_string .= "<td>$row[date]</td>";
					$display_string .= "<td>$row[price]</td>";
					$display_string .= "</tr>";
				
					$i = $i + 1;
				}
				
				$display_string .= "</tbody>";
				$display_string .= "</table>";
				$display_string .= "<button type='button' name='excel' value='excel' onclick='excel()'>EXPORT</button>";
							}
			else if($mode == -1)
			{
				$display_string = "<button type = 'button' onclick='del()'>Delete</button>";
				$display_string .= "<table id='searchresult' border=1 style='width:100%'>";
				$display_string .= "<thead>";
				$display_string .= "<tr>";
				$display_string .= "<th><span>S.no</span></th>";
				$display_string .= "<th>#</th>";
				$display_string .= "<th><span>Model No</span></th>";
				$display_string .= "<th><span>Brand</span></th>";
				$display_string .= "<th><span>size</span></th>";
				$display_string .= "<th><span>type</span></th>";
				$display_string .= "<th><span>sub-type</span></th>";
				$display_string .= "<th colspan='2'><span>SALE</span></th>";
				$display_string .= "<th><span>pics</span></th>";
				$display_string .= "<th><span>make</span></th>";
				$display_string .= "<th><span>color</span></th>";
				$display_string .= "<th><span>Date</span></th>";
				$display_string .= "<th><span>Price</span></th>";
				$display_string .= "</tr>";
				$display_string .= "</thead>";
				$display_string .= "<tbody>";
				
				$i = 1;
			
				while($row = mysql_fetch_array($result))
				{
					$display_string .= "<tr>";
					$display_string .= "<td>$i</td>";
					$display_string .= "<td align= bgcolor='#FFFFFF'><input type='checkbox' id='checkbox[$i]' value='$row[modelno]'></td>";
					$display_string .= "<td><a href='details.php?modelno=$row[modelno]';>$row[modelno]</a></td>";
					$display_string .= "<td>$row[brand]</td>";
					$display_string .= "<td>$row[size1] x $row[size2]</td>";
					$display_string .= "<td>$row[hdtype]</td>";
					$display_string .= "<td>$row[type]</td>";
					$display_string .= "<td>$row[salegod1]</td>";
					$display_string .= "<td>$row[salegod2]</td>";
					$display_string .= "<td>$row[pics]</td>";
					$display_string .= "<td>$row[make]</td>";
					$display_string .= "<td>$row[color]</td>";
					$display_string .= "<td>$row[date]</td>";
					$display_string .= "<td>$row[price]</td>";
					$display_string .= "</tr>";
				
					$i = $i + 1;
				}
				
				$display_string .= "</tbody>";
				$display_string .= "</table>";
				$display_string .= "<button type='button' name='excel' value='excel' onclick='excel()'>EXPORT</button>";
			}
			else 
			{
				$display_string = "<button type = 'button' onclick='del()'>Delete</button>";
				$display_string .= "<table id='searchresult' border=1 style='width:100%'>";
				$display_string .= "<thead>";
				$display_string .= "<tr>";
				$display_string .= "<th><span>S.no</span></th>";
				$display_string .= "<th>#</th>";
				$display_string .= "<th><span>Model No</span></th>";
				$display_string .= "<th><span>Brand</span></th>";
				$display_string .= "<th><span>size</span></th>";
				$display_string .= "<th><span>type</span></th>";
				$display_string .= "<th><span>sub-type</span></th>";
				$display_string .= "<th colspan='2'><span>STOCK</span></th>";
				$display_string .= "<th colspan='2'><span>SALE</span></th>";
				$display_string .= "<th><span>pics</span></th>";
				$display_string .= "<th><span>make</span></th>";
				$display_string .= "<th><span>color</span></th>";
				$display_string .= "<th><span>Date</span></th>";
				$display_string .= "<th><span>Price</span></th>";
				$display_string .= "</tr>";
				$display_string .= "</thead>";
				$display_string .= "<tbody>";
				
				$i = 1;
			
				while($row = mysql_fetch_array($result))
				{
					$display_string .= "<tr>";
					$display_string .= "<td>$i</td>";
					$display_string .= "<td align= bgcolor='#FFFFFF'><input type='checkbox' id='checkbox[$i]' value='$row[modelno]'></td>";
					$display_string .= "<td><a href='details.php?modelno=$row[modelno]';>$row[modelno]</a></td>";
					$display_string .= "<td>$row[brand]</td>";
					$display_string .= "<td>$row[size1] x $row[size2]</td>";
					$display_string .= "<td>$row[hdtype]</td>";
					$display_string .= "<td>$row[type]</td>";
					$display_string .= "<td>$row[stockgod1]</td>";
					$display_string .= "<td>$row[stockgod2]</td>";
					$display_string .= "<td>$row[salegod1]</td>";
					$display_string .= "<td>$row[salegod2]</td>";
					$display_string .= "<td>$row[pics]</td>";
					$display_string .= "<td>$row[make]</td>";
					$display_string .= "<td>$row[color]</td>";
					$display_string .= "<td>$row[date]</td>";
					$display_string .= "<td>$row[price]</td>";
					$display_string .= "</tr>";
				
					$i = $i + 1;
				}
				
				$display_string .= "</tbody>";
				$display_string .= "</table>";
				$display_string .= "<button type='button' name='excel' value='excel' onclick='excel()'>EXPORT</button>";
			}
			
		}
		
	}
}
else 
{
	$display_string = "auth";
}

echo $display_string;

?>

<?php
session_start ();

include '../Model/db.php';

$display_string = "auth";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{	
	$display_string = "error";
	
	$billno = $_POST ["billno"];
	$name = $_POST ["name"];
	$modelno = $_POST ["modelno"];
	$fdate = $_POST ["fdate"];
	$tdate = $_POST ["tdate"];
	$sprice = $_POST ["sprice"];
	$eprice = $_POST ["eprice"];
	$search = $_POST ["search"];
	$searchplus = $search + 10;
	$searchprev = $search - 10;
		
	$sql = "SELECT * FROM bill WHERE billno LIKE '$billno%' AND name LIKE '$name%'";

	/*if(!($modelno == ""))
	{
		$sql .= "AND modelno='$modelno' ";
	}*/

	if(!($fdate == "" || $tdate == "" ))
	{
		$sql .= "AND date between '$fdate' AND '$tdate' ";
	}
	
	if(!($sprice == "" || $eprice == ""))
	{
		$sql .= "AND total between '$sprice' AND '$eprice' ";    
	}

	$sql .= "LIMIT $search, $searchplus";
	
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
			$display_string = "";
			if(($_SESSION["role"] > 1))
			{
				$display_string .= "<button type = 'button' onclick='billdel()'>Delete</button>";
			}
			$display_string .= "<table id='searchresult' border=1 style='width:100%'>";
			$display_string .= "<thead>";
			$display_string .= "<tr>";
			$display_string .= "<th><span>no</span></th>";
			$display_string .= "<th>#</th>";
			$display_string .= "<th><span>Bill No</span></th>";
			$display_string .= "<th><span>Date</span></th>";
			$display_string .= "<th><span>Name</span></th>";
			$display_string .= "<th><span>Address</span></th>";
			$display_string .= "<th><span>Phone</span></th>";
			$display_string .= "<th><span>items</span></th>";
			$display_string .= "<th><span>Total</span></th>";
			$display_string .= "<th><span>Payable(with TAX)</span></th>";
			$display_string .= "<th><span>Balance</span></th>";
			$display_string .= "</tr>";
			$display_string .= "</thead>";
			$display_string .= "<tbody>";
			
			$i = $search+1;
			
			while($row = mysql_fetch_array($result))
			{
				$display_string .= "<tr>";
				$display_string .= "<td>$i</td>";
				$display_string .= "<td><input type='checkbox' id='checkbox[$i]' value='$row[billno]'></td>";
				if($_SESSION["role"] > 1)
				{
					$display_string .= "<td><a style='cursor:help;' onclick=billmenu('$row[billno]');>$row[billno]</a></td>";
				}
				else
				{
					$display_string .= "<td>$row[billno]</td>";
				}
				$display_string .= "<td>$row[date]</td>";
				$display_string .= "<td>$row[name]</td>";
				$display_string .= "<td>$row[address]</td>";
				$display_string .= "<td>$row[phone]</td>";
				$display_string .= "<td><table style='width:100%;'><thead><th>model</th><th>qty</th><th>Price</th></thead><tbody>$row[items]</tbody></table></td>";
				$display_string .= "<td>$row[total]</td>";
				$display_string .= "<td>$row[payable]</td>";
				$display_string .= "<td>$row[balance]</td>";
				$display_string .= "</tr>";
			
				$i = $i + 1;
			}
			
			$display_string .= "</tbody>";
			$display_string .= "</table>";
			$display_string .= "<a onclick='searchbill($searchprev)' style='float:left;'>PREV</a>";
			$display_string .= "<a onclick='searchbill($searchplus)' style='float:right;'>Next</a>";
							
		}	
	}
}


echo $display_string;

?>


<?php
session_start ();

$display_string = "auth";

if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{	
	include '../Model/db.php';
	
	$display_string = "error";
	
	if($_POST ["mode"] == 2)
	{
		$modelno = $_POST ["modelno"];
		$brand = $_POST ["brand"];
		$size1 = $_POST ["size1"];
		$size2 = $_POST ["size2"];
		$hdtype = $_POST ["hdtype"];
		$make = $_POST ["make"];
		$color = $_POST ["color"];
		$fdate = $_POST ["fdate"];
		$tdate = $_POST ["tdate"];
		$sprice = $_POST ["sprice"];
		$eprice = $_POST ["eprice"];
		$search = $_POST ["search"];
		$searchplus = $search + 10;
		$searchprev = $search - 10;
		
		$sql = "SELECT * FROM mainproduct WHERE modelno LIKE '$modelno%' AND brand LIKE '$brand%'";

		if(!($size1 == ""))
		{
			$sql .= "AND size1='$size1' ";
		}
		if(!($size2 == ""))
		{
			$sql .= "AND size2='$size2' " ;
		}
	
		$sql .= "AND hdtype LIKE '$hdtype%' AND make LIKE '$make%' AND color LIKE '$color%' ";

		if(!($fdate == "" || $tdate == "" ))
		{
			$sql .= "AND date between '$fdate' AND '$tdate' ";
		}
	
/*		if(!($sprice == "" || $eprice == ""))
		{
			$sql .= "AND price between '$sprice' AND '$eprice' ";    
		}
*/
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
					$display_string .= "<button type = 'button' onclick='del()'>Delete</button>";
				}
				$display_string .= "<table id='searchresult' border=1 style='width:100%'>";
				$display_string .= "<thead>";
				$display_string .= "<tr>";
				$display_string .= "<th><span>S.no</span></th>";
				$display_string .= "<th>#</th>";
				$display_string .= "<th><span>Model No</span></th>";
				$display_string .= "<th><span>Brand</span></th>";
				$display_string .= "<th><span>size</span></th>";
				$display_string .= "<th><span>type</span></th>";
				$display_string .= "<th colspan='2'><span>stock</span></th>";
				$display_string .= "<th><span>pics</span></th>";
				$display_string .= "<th><span>make</span></th>";
				$display_string .= "<th><span>color</span></th>";
				$display_string .= "<th><span>Date</span></th>";
				$display_string .= "<th><span>Price</span></th>";
				$display_string .= "</tr>";
				$display_string .= "</thead>";
				$display_string .= "<tbody>";
				
				$i = $search+1;
			
				while($row = mysql_fetch_array($result))
				{
					$display_string .= "<tr>";
					$display_string .= "<td>$i</td>";
					$display_string .= "<td align= bgcolor='#FFFFFF'><input type='checkbox' id='checkbox[$i]' value='$row[modelno]'></td>";
					if($_SESSION["role"] > 1)
					{
						$display_string .= "<td><a style='cursor:help;' onclick=modelmenu('$row[modelno]');>$row[modelno]</a></td>";
					}
					else 
					{
						$display_string .= "<td><a onclick=usermodelmenu('$row[modelno]')>$row[modelno]</a></td>";
					}
					$display_string .= "<td>$row[brand]</td>";
					$display_string .= "<td>$row[size1] x $row[size2]</td>";
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
				$display_string .= "<a onclick='searchprod($searchprev)' style='float:left;'>PREV</a>";
				$display_string .= "<a onclick='searchprod($searchplus)' style='float:right;'>Next</a>";
								
			}	
		}
	}

	else if($_POST ["mode"] == 1)
	{
		$modelno = $_POST ["modelno"];
		
		$sql = "SELECT * FROM mainproduct WHERE modelno = '$modelno'";
		
		
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
				$display_string = "";
				if(($_SESSION["role"] > 1))
				{
					$display_string .= "<button type = 'button' onclick='del()'>Delete</button>";
				}
				$display_string .= "<table id='searchresult' border=1 style='width:100%'>";
				$display_string .= "<thead>";
				$display_string .= "<tr>";
				$display_string .= "<th><span>S.no</span></th>";
				$display_string .= "<th><span>#</span></th>";
				$display_string .= "<th><span>Model No</span></th>";
				$display_string .= "<th><span>Brand</span></th>";
				$display_string .= "<th><span>size</span></th>";
				$display_string .= "<th><span>type</span></th>";
				$display_string .= "<th colspan='2'><span>quantity</span></th>";
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
					$display_string .= "<td align= bgcolor='#FFFFFF'><input name='checkbox[]' type='checkbox' id='checkbox[$i]' value='$row[modelno]'></td>";
					$display_string .= "<td><a href='details.php?modelno=$row[modelno]'>$row[modelno]</a></td>";
					$display_string .= "<td>$row[brand]</td>";
					$display_string .= "<td>$row[size1] x $row[size2]</td>";
					$display_string .= "<td>$row[type]</td>";
					$display_string .= "<td>$row[god1]</td>";
					$display_string .= "<td>$row[god2]</td>";
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
					
					
				if($i == 1)
				{
					$display_string = "null";
				}
					
			}
		
		}
		
	}
}

echo $display_string;

?>
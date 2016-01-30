<?php
session_start();
if (isset ( $_SESSION ["user"] ) && ($_SESSION["role"] > 0))
{
	$billno = $_GET ["billno"];
	
	?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Lakshmi Traders Invoice</title>
<link rel='stylesheet' type='text/css' href='View/CSS/style.css' />
<link rel='stylesheet' type='text/css' href='View/CSS/print.css' media="print" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="shortcut icon" href="View/resource/favicon.ico" type="image/x-icon">
<link rel="icon" href="View/resource/favicon.ico" type="image/x-icon">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>


<script>
	$(function() 
	{
		$("#billno").autocomplete({
	        source: "Model/billsearch.php",
	        minLength: 1
	    });
	});
	
	function printfill()
	{
		var billno = document.getElementById("billno").value;
		if(billno == "")
		{
			billno = "<?php echo $billno;?>";
		}
		var hr2 = new XMLHttpRequest();				        
        hr2.open("POST", "Controller/billfill.php", true);
		hr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		hr2.onreadystatechange = function() 
		{
			console.log(hr2);
			if(hr2.readyState == 4 && hr2.status == 200) 
			{
				var rdata2 = JSON.parse(hr2.responseText);
				document.getElementById("date").value = rdata2["date"];
				document.getElementById("name").value = rdata2["name"];
				document.getElementById("address").value = rdata2["address"];							
				document.getElementById("items").innerHTML = "<table style='width:100%;'><th>Model</th><th>QTY</th><th>PRICE</th>"+rdata2["items"]+"</table>";
				document.getElementById("total").value = rdata2["total"];
				document.getElementById("tax").value = rdata2["tax"];
				document.getElementById("discount").value = rdata2["discount"];
				document.getElementById("pay").value = rdata2["payable"];
				document.getElementById("recvd").value = rdata2["recvd"];
				document.getElementById("balance").value = rdata2["balance"];
			}
		};
		var vars2 = "billno="+billno;
		hr2.send(vars2);
	}

	function printPage()
	{
		$('input').css({'background':'none','border':'none'});
		$('textarea').css({'background':'none','border':'none'});
		window.print();
	}
</script>

</head>
<body>
	<div style="padding: 1%">
		<div style="padding-bottom: 10%;">
			<div style="float: left;">
				<h1>Lakshmi Traders</h1>
				<br> Puducherry | Chennai <br>
			
			</div>
			<div style="float: right;">
				<img src="View/resource/watermark.jpg" alt="" width="20%" style="float:right;" />
			</div>
		</div>
		
		<!---------------------------------- Form Starts Here    -----------------------------------------------------------------  -->
		<form>
		<table border="1" style="width: 100%">
			<tr>
				<td style="width: 50%">Bill no: <input id="billno" onblur="printfill();" style="width: 30%;" required="required" value="<?php echo $billno;?>" style="float:right;"> Date: <input id="date" style="float:right;" required="required"/></l></td>
				<td><i style="float: right;">Tax INVOICE</i></td>
			</tr>
			<tr>
				<td>TIN NO: <input style="float: right;" /> &nbsp; <br><br>Service Tax No: <input style="float: right;" />&nbsp;</td>
				<td>CST NO: <input style="float: right;" /> &nbsp; <br><br></td>
			</tr>
			<tr>
				<td>Customer Name and Address <input id="name" style="float: right;" required="required" /></td>
				<td>Delivery Address</td>
			</tr>
			<tr>
				<td><textarea id="address" rows="3" style="width: 100%;"></textarea><br><br>GST No: <input /></td>
				<td><textarea rows="4" style="width: 100%;"></textarea><br></br>Mobile: <input style="float: right;"/></td>
			</tr>
		</table>
		<br>
		
		<div>
			&nbsp;&nbsp;Transporter Name: <input /> &nbsp;&nbsp; Vehicle No: <input />
		</div>
		<br>
		<table style="width: 100%;">
			<tr>
				<th colspan="5">Items</th>
			</tr>
			<tr><td colspan="5" id="items">
			
			</td>
			</tr>
			<tr>
				<td colspan="2" class="blank" style='border-bottom:0;border-top:0;'><br>Payment Mode <input style="width: 30%" /> Cash: <input style="width: 30%; float: right;" />
				</td>
				<td colspan="2" class="total-line">Total</td>
				<td class="total-value"><input id="total" readonly="readonly" /></td>
			</tr>
			<tr>
				<td colspan="2" class="blank" style='border-bottom:0;border-top:0;'>Cheque No: <input style="float: right;"/></td>
				<td colspan="2" class="total-line">TAX</td>
				<td class="total-value"><input id="tax" /></td>
			</tr>
			<tr>
				<td colspan="2" class="blank" style='border-bottom:0;border-top:0;' >Cheque Date: <input style="float: right;"/></td>
				<td colspan="2" class="total-line">Discount</td>
				<td class="total-value"><input id="discount" value="0" /></td>
			</tr>
			<tr>
				<td colspan="2" style='border-bottom:0;border-top:0;' class="blank"></td>
				<td colspan="2" class="total-line balance">Payable </td>
				<td class="total-value balance"><input id="pay" value="Rs0" /></td>
			</tr>
			<tr>
				<td colspan="2" class="blank" style='border-bottom:0;border-top:0;'></td>
				<td colspan="2" class="total-line balance">Recieved</td>
				<td class="total-value balance"><input id="recvd" readonly="readonly" /></td>
			</tr>
			<tr>
				<td colspan="2" class="blank" ></td>
				<td colspan="2" class="total-line balance">Balance</td>
				<td class="total-value balance"><input id="balance" readonly="readonly" /></td>
			</tr>
		</table>
		<div>
			In Words <br><input style="display: block; width: 100%" /><br>
		</div>
		<div>
			<table style="width: 100%">
				<tr>
					<td style="width: 65%"><br>NOTE: 
					
					<br> 1. For all product warranty belongs to Manufacture
									only 
					
					<br> 2. All disputes are subjected to Chennai jurisdiction only <br>
								3.Material once sold will not be taken back <br> 4.This is
									computer generated invoice Signature is not mandatory</td>
					<td>For <i>Lakshmi Traders</i><br><br></br><l style="float:right">AUTHORISED SIGNATORY</l></td>
				</tr>
			</table>
			<button type="button" onclick="printPage();">Print</button>
			</form>
		</div>
	</div>
	<div>
		<br><br><br><br><br><br><br><br>
	</div>
	<script type="text/javascript">printfill();</script>
</body>
</html>

<?php 
}
else
{
	echo "unauthorised login: please close";
}

?>


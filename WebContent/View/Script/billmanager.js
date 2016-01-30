$(function() 
{
	$("#print").hide();
	$(".modelno").autocomplete({
        source: "Model/modelsearch.php",
        minLength: 1
    });
	
	$("#addrow").click(function()
			{
				$(".items:last").after("<tr class='items'><td bgcolor='grey'>Modelno</td><td><input type='text' class = 'modelno' required='required'></td><td bgcolor='grey'>No of Box</td><td><select class='god'><option value='1'>Godown 1</option><option value='2'>Godown 2</option></select><input type='number' required='required' placeholder='qty' class='qty'><label>X</label><input type='number' class='sprice' placeholder='price per box'/></td><td bgcolor='grey'>Price</td><td><input type='number' required='required' readonly='readonly' class='price'><button type='button' class='delrow' style='float: right;'>-</button></td></tr>"); 
				$(".modelno").autocomplete({
		  	        source: "Model/modelsearch.php",
		  	        minLength: 1
		  	    });
			});
	
	$('body').on('click','.delrow',function()
		  	{
		  		$(this).parents('.items').remove();
		  		update_total();
		  	});
	
	
	$("body").on('change','.modelno, .qty',function()
	{
		$("#print").hide();
		var row = $(this).parents('.items');
		var product = row.find('.modelno').val();
		var qty = row.find('.qty').val();
		var vars = "modelno="+product;
		  				
		var hr = new XMLHttpRequest();
		var url = "Controller/godowncheck.php";
		hr.open("POST", url, true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() 
		{
			console.log(hr);
		    if(hr.readyState == 4 && hr.status == 200) 
			{
		    	var rdata = JSON.parse(hr.responseText);
		    	if(rdata['exist'] == 'yes')
		    	{
		    		var stockgod1 = parseInt(rdata['stockgod1']);
		    		var stockgod2 = parseInt(rdata['stockgod2']);
		    		var sprice = parseInt(rdata['price']);
		    		var god = row.find('.god').val();
		    		if(god == 1)
		    		{
		    			if(qty > stockgod1)
		    			{
		    				row.find('.qty').val(stockgod1);
		    			}
		    		}
		    		else if(god == 2)
		    		{
		    			if(qty > stockgod2)
		    			{
		    				row.find('.qty').val(stockgod2);
		    			}
		    		}
		    		row.find('.sprice').val(sprice);
		    		var price = row.find('.qty').val() * row.find('.sprice').val();
		    		row.find('.price').val(price);
		    		
		    		update_total();
		  	   	}
		     	else
		     	{
		     		alert("No stocks");
		     		row.find('.modelno').val("");
		     	}
			}
		};
		hr.send(vars);
		  				
	});
	
	$("body").on('change','.sprice',function()
	{
		var row = $(this).parents('.items');
		var price = row.find('.qty').val() * row.find('.sprice').val();
		row.find('.price').val(price);
		update_total();
		
	});
	
	$("body").on('change','#discount, #tax, #recvd',function()
	{
		update_pay();
				
	});
	
	
	
	
});

function update_total() 
{
	var total = 0;
	$('.price').each(function(i)
	{
		price = $(this).val();
		total += Number(price);
	});

	//total = roundNumber(total,2);

	$('#total').val(total);
  
	update_pay();
}

function update_pay()
{
	var pay = 0;
	var total = $('#total').val();
	var tax = $('#tax').val()*total/100;
	var discount = $('#discount').val();
	pay = parseInt(total) + parseInt(tax) - parseInt(discount);
	pay = roundNumber(pay,2);
	$('#payable').val(pay);
	var recvd = $('#recvd').val();
	var balance = pay - recvd;
	$('#balance').val(balance);

}

function roundNumber(number,decimals) {
	  var newString;// The new rounded number
	  decimals = Number(decimals);
	  if (decimals < 1) {
	    newString = (Math.round(number)).toString();
	  } else {
	    var numString = number.toString();
	    if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
	      numString += ".";// give it one at the end
	    }
	    var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
	    var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
	    var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
	    if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
	      if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
	        while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
	          if (d1 != ".") {
	            cutoff -= 1;
	            d1 = Number(numString.substring(cutoff,cutoff+1));
	          } else {
	            cutoff -= 1;
	          }
	        }
	      }
	      d1 += 1;
	    } 
	    if (d1 == 10) {
	      numString = numString.substring(0, numString.lastIndexOf("."));
	      var roundedNum = Number(numString) + 1;
	      newString = roundedNum.toString() + '.';
	    } else {
	      newString = numString.substring(0,cutoff) + d1.toString();
	    }
	  }
	  if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
	    newString += ".";
	  }
	  var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
	  for(var i=0;i<decimals-decs;i++) newString += "0";
	  //var newNumber = Number(newString);// make it a number if you like
	  return newString; // Output the result to the form field (change for your purposes)
}


function billgo()
{
	$("#ajldr" ).show( 100 );
	
	var hr = new XMLHttpRequest();
	var url = "Controller/billgo.php";
	var billno = document.getElementById("billno").value;
	
	if(billno == "")
	{
		
	}
	else
	{
		var vars = "billno="+billno;
		hr.open("POST", url, true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() 
		{
			console.log(hr);
		    if(hr.readyState == 4 && hr.status == 200) 
			{
		    	var rdata = hr.responseText;
		    	if(rdata.trim() == "empty")
		    	{
		    		clrscr();
		    		$("#ajldr").hide( 100 );
		    	}
		    	else if(rdata.trim() == "error")
		    	{
		    		alert("Error");
		    		$("#ajldr").hide( 100 );
		    	}
		    	else if(rdata.trim() == 'exist')
		    	{
		    		var hr2 = new XMLHttpRequest();				        
			        hr2.open("POST", "Controller/billfill.php", true);
					hr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

					hr2.onreadystatechange = function() 
					{
						console.log(hr2);
						if(hr2.readyState == 4 && hr2.status == 200) 
						{
							var rdata2 = JSON.parse(hr2.responseText);
							document.getElementById("billdate").value = rdata2["date"];
					    	document.getElementById("name").value = rdata2["name"];
							document.getElementById("address").value = rdata2["address"];
							document.getElementById("phone").value = rdata2["phone"];
							document.getElementById("items").value = rdata2["items"];
							document.getElementById("total").value = rdata2["total"];
							document.getElementById("discount").value = rdata2["discount"];
							document.getElementById("tax").value = rdata2["tax"];
							document.getElementById("payable").value = rdata2["payable"];
							document.getElementById("recvd").value = rdata2["recvd"];
							document.getElementById("balance").value = rdata2["balance"];
							
							$("#ajldr").hide( 100 );						
						}
					};
					var vars2 = "billno="+billno;
					hr2.send(vars2);
		    	}
		    	else
		    	{
		    		alert(rdata);
		    		$("#ajldr").hide( 100 );
		    	}
			}
		};
		hr.send(vars);
	}
}

function billmenu(billno)
{
	$("#dialog-confirm").html("Print or edit");

	    // Define the Dialog and its properties.
	$("#dialog-confirm").dialog({
		resizable: false,
		modal: true,
	    title: "Print or Edit",
	    height: 250,
	    width: 400,
	    buttons: {
	    	"PRINT": function () {
	    		$(this).dialog('close');
	    		window.location.href = 'print.php?billno='+billno;
	    	},
	        "EDIT": function () {
	        	$(this).dialog('close');
	        	window.location.href = 'edit.php?billno='+billno;
	        }
	    }
	});
}

function addbill()
{
	$("#ajldr").show( 100 );	
	
	var url = "Controller/addbill.php";
	
	var billno = document.getElementById("billno").value;
	var date = document.getElementById("date").value;
	var name = document.getElementById("name").value;
	var address = document.getElementById("address").value;
	var phone = document.getElementById("phone").value;
	var total = document.getElementById("total").value;
	var disc = document.getElementById("discount").value;
	var tax = document.getElementById("tax").value;
	var pay = document.getElementById("payable").value;
	var recvd = document.getElementById("recvd").value;
	var bal = document.getElementById("balance").value;
	
	var product = [];
	var qty = [];
	var god = [];
	var price = [];
	var sql = "";
	
	var i = 1;
	jQuery(document).ready(function()
	{ 
		$(".modelno").map(function()
		{
			product[i] = $(this).val();
			i++;
		}).get();
		
		i=1;
		
		$(".qty").map(function()
		{
		 	qty[i] = $(this).val();
		  	i++;
		}).get();
		
		i=1;
		
		$(".god").map(function()
		{
		 	god[i] = $(this).val();
		  	i++;
		}).get();
		
		i=1;
		$(".sprice").map(function()
		{
		 	price[i] = $(this).val();
		  	i++;
		}).get();
	});
	
	var items = "";
    for(var j=1; j<product.length; j++ )
    {
    	items += "<tr><td>"+product[j]+"</td><td>"+qty[j]+"</td><td>"+price[j]+"</td></tr>";
    	if(god[j] == 1)
    	{
    		sql += "UPDATE `mainproduct` SET `stockgod1` = stockgod1 -'"+qty[j]+"', `salegod1` = salegod1#'"+qty[j]+"' WHERE modelno = '"+product[j]+"';";
    	}
    	else if(god[j] == 2)
    	{
    		sql += "UPDATE `mainproduct` SET `stockgod2` = stockgod2 -'"+qty[j]+"', `salegod2` = salegod2#'"+qty[j]+"' WHERE modelno = '"+product[j]+"';";
    	}
   	}

    sql += "INSERT into `bill` (`billno`,`date`,`name`,`address`,`phone`,`items`, `total`,`discount`,`tax`,`payable`,`recvd`,`balance`) VALUES ('"+billno+"','"+date+"','"+name+"','"+address+"','"+phone+"','"+items+"','"+total+"','"+disc+"','"+tax+"','"+pay+"','"+recvd+"','"+bal+"');";
	
    var vars = "sql="+sql;
    
	var hr = new XMLHttpRequest();
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	        var rdata = hr.responseText;
	        if(rdata.trim() == "success")
	        {
	        	$("#print").show();
	        	$("#ajldr").hide( 100 );
	        }
	        else
	        {
	        	alert(rdata);
	        	$("#ajldr").hide( 100 );
	        }
		}
	};
	hr.send(vars);
	
	
}

function showbill()
{
	alert("success");
}

function searchbill(i)
{	
	$("#ajldr" ).show( 100 );

	var hr = new XMLHttpRequest();
	
	var url = "Controller/searchbill.php";

	var billno = document.getElementById("billno").value;
	var name = document.getElementById("name").value;
	var fdate = document.getElementById("fdate").value;
	var tdate = document.getElementById("tdate").value;
	var sprice = $( "#billpriceslider" ).slider( "values", 0 );
	var eprice = $( "#billpriceslider" ).slider( "values", 1 );
	
	var vars = "billno="+billno+"&name="+name+"&modelno="+modelno+"&fdate="+fdate+"&tdate="+tdate+"&sprice="+sprice+"&eprice="+eprice+"&search="+i;	

	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	        var rdata = hr.responseText;
	        $("#ajldr").hide( 100 );
	        
			if(rdata == "error")
			{
				alert("problem at server");
			}
			else if(rdata == "auth")
			{
				alert("Auth problem");
			}
			else if(rdata == "null")
			{
				$("#billform" ).hide( 400 );
				var result = document.getElementById("result");
				result.innerHTML = "Empty Table || No items";
			}
			else
			{
				$("#billform" ).hide( 400 );
				var result = document.getElementById("result");
				result.innerHTML = rdata;
				$("#searchresult").tablesorter(); 
			}
		}
	};
	hr.send(vars);
	
}



function reloadbillno()
{
	$("#print").hide();
	$("#submit").show();
	var hr = new XMLHttpRequest();
	var url = "Controller/random.php";
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	    	document.getElementById("billno").value = hr.responseText;
		}
	};
	hr.send();
}

function billdel()
{
	$("#ajldr" ).show( 100 );
	var i = 1;
	var sql = "";
	for(i = 1; i <= 10; i++)
	{
		var elem = document.getElementById("checkbox["+i+"]");
		if(elem == null)
		{
			
		}
		else
		{
			var x = document.getElementById("checkbox["+i+"]").checked;
			if(x)
			{
				var y = document.getElementById("checkbox["+i+"]").value;
			
				sql += "DELETE FROM bill WHERE billno ='"+y+"';";
			
			}
		}
	}
	var vars = "sql="+sql;
	var hr = new XMLHttpRequest();
	var url = "Controller/delete.php";
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// Access the onreadystatechange event for the XMLHttpRequest object
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	    	var rdata = hr.responseText.trim();
	    	$("#ajldr").hide( 100 );
			if(rdata.trim() == "success")
			{
				searchbill(0);
			}
			else
			{
				alert(rdata);
			}

			
		}
		
	};
	hr.send(vars);
	
}

function updatebill()
{
$("#ajldr").show( 100 );	
	
	var url = "Controller/updatebill.php";
	
	var billno = document.getElementById("billno").value;
	var date = document.getElementById("billdate").value;
	var name = document.getElementById("name").value;
	var address = document.getElementById("address").value;
	var phone = document.getElementById("phone").value;
	var items = document.getElementById("items").value;
	var total = document.getElementById("total").value;
	var disc = document.getElementById("discount").value;
	var tax = document.getElementById("tax").value;
	var pay = document.getElementById("payable").value;
	var recvd = document.getElementById("recvd").value;
	var bal = document.getElementById("balance").value;

	var vars = "billno="+billno+"&date="+date+"&name="+name+"&address="+address+"&phone="+phone+"&items="+items+"&total="+total+"&disc="+disc+"&tax="+tax+"&pay="+pay+"&recvd="+recvd+"&bal="+bal+"&oldbox1="+oldbox1+"&oldbox2="+oldbox2;
	
	var hr = new XMLHttpRequest();
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	        var rdata = hr.responseText.trim();
	        $("#ajldr").hide( 100 );
	        if(rdata == "success")
	        {
	        	showbill(0);
	        }
	        else
	        {
	        	alert(rdata);
	        }
		}
	};
	hr.send(vars);
	

}
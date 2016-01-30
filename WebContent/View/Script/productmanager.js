
function go()
{
	$("#ajldr" ).show( 100 );
	
	var hr = new XMLHttpRequest();
	var url = "Controller/go.php";
	var modelno = document.getElementById("modelno").value;
	
	if(modelno == "")
	{
		
	}
	else
	{
		var vars = "modelno="+modelno;
		hr.open("POST", url, true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() 
		{
			console.log(hr);
		    if(hr.readyState == 4 && hr.status == 200) 
			{
		    	var rdata = hr.responseText;
		    	$("#ajldr").hide( 100 );
		    	if(rdata.trim() == "empty")
		    	{
		    		clrscr();
		    	}
		    	else if(rdata.trim() == "error")
		    	{
		    		alert("Error");
		    	}
		    	else if(rdata.trim() == 'exist')
		    	{
		    		exist();
		    		var hr2 = new XMLHttpRequest();				        
			        hr2.open("POST", "Controller/fill.php", true);
					hr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

					hr2.onreadystatechange = function() 
					{
						console.log(hr2);
						if(hr2.readyState == 4 && hr2.status == 200) 
						{
							var rdata2 = JSON.parse(hr2.responseText);
					    	document.getElementById("brand").value = rdata2["brand"];
							document.getElementById("brand").disabled = true;
							document.getElementById("size1").value = rdata2["size1"];
							document.getElementById("size1").disabled = true;
							document.getElementById("size2").value = rdata2["size2"];
							document.getElementById("size2").disabled = true;
							document.getElementById("type").value = rdata2["hdtype"];
							
							if(rdata2["hdtype"] == "floor")
							{
								document.getElementById("floortype").value = rdata2["type"];
								$("#floortype").show( 100 );
								$("#parkingtype").hide( 100 );
								$("#vitrifiedtype").hide( 100 );
								$("#walltype").hide( 100 );
							}
							else if(rdata2["hdtype"] == "wall")
							{
								document.getElementById("walltype").value = rdata2["type"];
								$("#floortype").hide( 100 );
								$("#parkingtype").hide( 100 );
								$("#vitrifiedtype").hide( 100 );
								$("#walltype").show( 100 );
							}
							else if(rdata2["hdtype"] == "vitrified")
							{
								document.getElementById("vitrifiedtype").value = rdata2["type"];
								$("#floortype").hide( 100 );
								$("#parkingtype").hide( 100 );
								$("#vitrifiedtype").show( 100 );
								$("#walltype").hide( 100 );
							}
							else if(rdata2["hdtype"] == "parking")
							{
								document.getElementById("parkingtype").value = rdata2["type"];
								$("#floortype").hide( 100 );
								$("#parkingtype").show( 100 );
								$("#vitrifiedtype").hide( 100 );
								$("#walltype").hide( 100 );
							}
							document.getElementById("type").disabled = true;
							document.getElementById("god1").value = rdata2["god1"];
							document.getElementById("god1").disabled = true;
							document.getElementById("god2").value = rdata2["god2"];
							document.getElementById("god2").disabled = true;
							document.getElementById("pics").value = rdata2["pics"];
							document.getElementById("pics").disabled = true;
							document.getElementById("make").value = rdata2["make"];
							document.getElementById("make").disabled = true;
							document.getElementById("color").value = rdata2["color"];
							document.getElementById("color").disabled = true;
							document.getElementById("date").value = rdata2["date"];
							document.getElementById("date").disabled = false;
							document.getElementById("price").value = rdata2["price"];
							document.getElementById("price").disabled = false;
						}
					};
					var vars2 = "modelno="+modelno;
					hr2.send(vars2);
		    	}
		    	else
		    	{
		    		alert(rdata);
		    		
		    	}
			}
		};
		hr.send(vars);
	}
	
}

function add()
{
	$("#ajldr").show( 100 );	
	
	var url;
	
	var modelno = document.getElementById("modelno").value;
	var brand = document.getElementById("brand").value;
	var size1 = document.getElementById("size1").value;
	var size2 = document.getElementById("size2").value;
	var hdtype = document.getElementById("type").value;

	var type = "";
	
	if(hdtype == "floor")
	{
		type = document.getElementById("floortype").value;
	}
	else if(hdtype == "parking")
	{
		type = document.getElementById("parkingtype").value;
	}
	else if(hdtype == "vitrified")
	{
		type = document.getElementById("vitrifiedtype").value;
	}
	else if(hdtype == "wall")
	{
		type = document.getElementById("walltype").value;
	}
	var god1 = document.getElementById("god1").value;
	var adgod1 = document.getElementById("adgod1").value;
	var god2 = document.getElementById("god2").value;
	var adgod2 = document.getElementById("adgod2").value;
	var pics = document.getElementById("pics").value;
	var m = document.getElementById("make");
	var make = m.options[m.selectedIndex].value;
	var color = document.getElementById("color").value;
	var date = document.getElementById("date").value;
	var price = document.getElementById("price").value;
	
	var vars;
	
	if((adgod1 != "")||(adgod2 != ""))
	{
		if(adgod1 == "")
		{
			adgod1 = 0;
		}
		else
		{
			adgod2 = 0;
		}
		url = "Controller/update.php";
		
		vars = "modelno="+modelno+"&adgod1="+adgod1+"&adgod2="+adgod2+"&date="+date+"$price="+price;	
	}
	else
	{
		url = "Controller/add.php";
		
		vars = "modelno="+modelno+"&brand="+brand+"&size1="+size1+"&size2="+size2+"&hdtype="+hdtype+"&type="+type+"&god1="+god1+"&god2="+god2+"&pics="+pics+"&make="+make+"&color="+color+"&date="+date+"&price="+price;	
	}
	
	var hr = new XMLHttpRequest();
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	        var rdata = hr.responseText;
	        $("#ajldr").hide( 100 );
	        if(rdata.trim() == "success")
	        {
	        	show();
	        }
	        else
	        {
	        	alert(rdata);
	        }
		}
	};
	hr.send(vars);
	
	addImage();
	
}

function addImage()
{
	
}

function show()
{
	var modelno = document.getElementById("modelno").value;
	
	var hr = new XMLHttpRequest();
	
	hr.open("POST", "Controller/search.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	hr.onreadystatechange = function() 
	{
		console.log(hr);
		if(hr.readyState == 4 && hr.status == 200) 
		{
			var rdata = hr.responseText;
			var result = document.getElementById("result");
			result.innerHTML = rdata;
			modelmenu();
			usermodelmenu();
		}
	};

	var vars = "mode=1&modelno="+modelno;
	hr.send(vars);	
	
}

function del()
{
	$("#ajldr" ).show( 100 );
	var i = 1;
	var sql = "";
	for(i = 1; i <= 10; i++)
	{
		var elem = document.getElementById("checkbox["+i+"]");
		if(elem == null)
		{
			i = 10;
		}
		else
		{
			var x = document.getElementById("checkbox["+i+"]").checked;
			if(x)
			{
				var y = document.getElementById("checkbox["+i+"]").value;
			
				sql += "DELETE FROM mainproduct WHERE modelno='"+y+"';";
			
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
	    	var rdata = hr.responseText;
	    	$("#ajldr").hide( 100 );
			if(rdata.trim() == "success")
			{
				searchprod(0);

			}
			else
			{
				alert(rdata);
			}

			
		}
		
	};
	hr.send(vars);
	
}

function searchprod(i)
{	
	$("#ajldr" ).show( 100 );

	var hr = new XMLHttpRequest();
	
	var url = "Controller/search.php";

	var modelno = document.getElementById("modelno").value;
	var brand = document.getElementById("brand").value;
	var size1 = document.getElementById("size1").value;
	var size2 = document.getElementById("size2").value;
	var t = document.getElementById("type");
	var hdtype = t.options[t.selectedIndex].value;
	var m = document.getElementById("make");
	var make = m.options[m.selectedIndex].value;
	var color = document.getElementById("color").value;
	var fdate = document.getElementById("fdate").value;
	var tdate = document.getElementById("tdate").value;
	var sprice = $( "#prodpriceslider" ).slider( "values", 0 );
	var eprice = $( "#prodpriceslider" ).slider( "values", 1 );
	
	var vars = "mode=2&modelno="+modelno+"&brand="+brand+"&size1="+size1+"&size2="+size2+"&hdtype="+hdtype+"&type="+type+"&make="+make+"&color="+color+"&fdate="+fdate+"&tdate="+tdate+"&sprice="+sprice+"&eprice="+eprice+"&search="+i;	
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	        var rdata = hr.responseText;
	        $("#ajldr").hide( 100 );
			if(rdata.trim() == "error")
			{
				alert("problem at server");
			}
			else if(rdata.trim() == "auth")
			{
				alert("Auth problem");
			}
			else if(rdata.trim() == "null")
			{
				$("#searchform" ).hide( 400 );
				var result = document.getElementById("result");
				result.innerHTML = "Empty Table || No items";
			}
			else
			{
				$("#searchform" ).hide( 400 );
				var result = document.getElementById("result");
				result.innerHTML = rdata;
				$("#searchresult").tablesorter(); 
			}
		}
	};
	hr.send(vars);
	
	
}

function mis()
{
	//i == 0 ALL
	//i == 1 STOCK
	//i == -1 SALE
	$("#ajldr" ).show( 100 );
	
	var hr = new XMLHttpRequest();
	// Create some variables we need to send to our PHP file
	var url = "Controller/mis.php";
	
	var choice = 0;
	if(document.getElementById("stock").checked)
	{
		choice = 1;
	}
	else if(document.getElementById("sale").checked)
	{
		choice = -1;
	}
	else
	{
		choice = 0;
	}
	
	var modelno = document.getElementById("modelno").value;
	var brand = document.getElementById("brand").value;
	var t = document.getElementById("type");
	var hdtype = t.options[t.selectedIndex].value;
	var fdate = document.getElementById("fdate").value;
	var tdate = document.getElementById("tdate").value;
	
	var vars = "mode="+choice+"&modelno="+modelno+"&brand="+brand+"&hdtype="+hdtype+"&fdate="+fdate+"&tdate="+tdate;	
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
				alert("No result found");
			}
			else
			{
				var result = document.getElementById("result");
				result.innerHTML = rdata;
				
				$("#searchresult").tablesorter(); 
			}
	        
		}
	};		
	hr.send(vars);


}

function excel()
{
   var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#result').html());
   location.href=url;
   return false;
}

function modelmenu(modelno)
{
	$("#dialog-confirm").html("Add this stock to bill or edit");

	    // Define the Dialog and its properties.
	$("#dialog-confirm").dialog({
		resizable: false,
		modal: true,
	    title: "Edit or Bill",
	    height: 250,
	    width: 400,
	    buttons: {
	    	"BILL": function () {
	    		$(this).dialog('close');
	    		window.location.href = 'billing.php?modelno='+modelno;
	    	},
	        "EDIT": function () {
	        	$(this).dialog('close');
	        	window.location.href = 'edit.php?modelno='+modelno;
	        }
	    }
	});
}



function editgo()
{
$("#ajldr" ).show( 100 );
	
	var hr = new XMLHttpRequest();
	var url = "Controller/go.php";
	var modelno = document.getElementById("modelno").value;
	
	if(modelno == "")
	{
		$("#ajldr").hide( 100 );
	}
	else
	{
		var vars = "modelno="+modelno;
		hr.open("POST", url, true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() 
		{
			console.log(hr);
		    if(hr.readyState == 4 && hr.status == 200) 
			{
		    	var rdata = hr.responseText;
		    	$("#ajldr").hide( 100 );
		    	if(rdata.trim() == "empty")
		    	{
		    		clrscr();
		    	}
		    	else if(rdata.trim() == "error")
		    	{
		    		alert("Error");
		    	}
		    	else if(rdata.trim() == 'exist')
		    	{
		    		var hr2 = new XMLHttpRequest();				        
			        hr2.open("POST", "Controller/fill.php", true);
					hr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

					hr2.onreadystatechange = function() 
					{
						console.log(hr2);
						if(hr2.readyState == 4 && hr2.status == 200) 
						{
							var rdata2 = JSON.parse(hr2.responseText);
							document.getElementById("newmodelno").value = rdata2["modelno"];
					    	document.getElementById("brand").value = rdata2["brand"];
							document.getElementById("size1").value = rdata2["size1"];
							document.getElementById("size2").value = rdata2["size2"];
							document.getElementById("type").value = rdata2["hdtype"];
							if(rdata2["hdtype"] == "floor")
							{
								document.getElementById("floortype").value = rdata2["type"];
								$("#floortype").show( 100 );
								$("#parkingtype").hide( 100 );
								$("#vitrifiedtype").hide( 100 );
								$("#walltype").hide( 100 );
							}
							else if(rdata2["hdtype"] == "wall")
							{
								document.getElementById("walltype").value = rdata2["type"];
								$("#floortype").hide( 100 );
								$("#parkingtype").hide( 100 );
								$("#vitrifiedtype").hide( 100 );
								$("#walltype").show( 100 );
							}
							else if(rdata2["hdtype"] == "vitrified")
							{
								document.getElementById("vitrifiedtype").value = rdata2["type"];
								$("#floortype").hide( 100 );
								$("#parkingtype").hide( 100 );
								$("#vitrifiedtype").show( 100 );
								$("#walltype").hide( 100 );
							}
							else if(rdata2["hdtype"] == "parking")
							{
								document.getElementById("parkingtype").value = rdata2["type"];
								$("#floortype").hide( 100 );
								$("#parkingtype").show( 100 );
								$("#vitrifiedtype").hide( 100 );
								$("#walltype").hide( 100 );
							}
							document.getElementById("god1").value = rdata2["god1"];
							document.getElementById("god2").value = rdata2["god2"];
							document.getElementById("pics").value = rdata2["pics"];
							document.getElementById("make").value = rdata2["make"];
							document.getElementById("color").value = rdata2["color"];
							document.getElementById("date").value = rdata2["date"];
							document.getElementById("prodprice").value = rdata2["price"];
						}
					};
					var vars2 = "modelno="+modelno;
					hr2.send(vars2);
		    	}
		    	else
		    	{
		    		alert(rdata);
		    		
		    	}
			}
		};
		hr.send(vars);
	}
	



}

function edit()
{
	$("#ajldr").show( 100 );
	var modelno = document.getElementById("modelno").value;
	var newmodelno = document.getElementById("newmodelno").value;
	var brand = document.getElementById("brand").value;
	var size1 = document.getElementById("size1").value;
	var size2 = document.getElementById("size2").value;
	var hdtype = document.getElementById("type").value;
	var type = "";
	
	if(hdtype == "floor")
	{
		type = document.getElementById("floortype").value;
	}
	else if(hdtype == "parking")
	{
		type = document.getElementById("parkingtype").value;
	}
	else if(hdtype == "vitrified")
	{
		type = document.getElementById("vitrifiedtype").value;
	}
	else if(hdtype == "wall")
	{
		type = document.getElementById("walltype").value;
	}
	var god1 = document.getElementById("god1").value;
	var god2 = document.getElementById("god2").value;
	var pics = document.getElementById("pics").value;
	var m = document.getElementById("make");
	var make = m.options[m.selectedIndex].value;
	var color = document.getElementById("color").value;
	var date = document.getElementById("date").value;
	var price = document.getElementById("prodprice").value;

	var vars = "modelno="+modelno+"&newmodelno="+newmodelno+"&brand="+brand+"&size1="+size1+"&size2="+size2+"&hdtype="+hdtype+"&type="+type+"&god1="+god1+"&god2="+god2+"&pics="+pics+"&make="+make+"&color="+color+"&date="+date+"&price="+price;	
	
	var url = "Controller/edit.php";
	
	var hr = new XMLHttpRequest();
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	        var rdata = hr.responseText;
	        $("#ajldr").hide( 100 );
	        if(rdata.trim() == "success")
	        {
	        	show();
	        }
	        else
	        {
	        	alert(rdata);
	        }
		}
	};
	hr.send(vars);
	
}

function gotoeditpage()
{
	var modelno = document.getElementById("modelno").value;
	window.location.href = 'edit.php?modelno='+modelno;	
}

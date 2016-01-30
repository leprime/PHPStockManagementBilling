function logn()
{
	$("#ajldr" ).show( 100 );

	var hr = new XMLHttpRequest();
	var url = "Controller/auth.php";
	var user = document.getElementById("user").value;
	var pass = document.getElementById("pass").value;
	var vars = "user="+user+"&pass="+pass;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() 
	{
		console.log(hr);
	    if(hr.readyState == 4 && hr.status == 200) 
		{
	        var rdata = hr.responseText;
	        $("#ajldr" ).hide( 100 );
			if(rdata == "success")
			{
				location.reload();
			}
			else
			{
				alert("login failed");
			}
	    }
	};
	hr.send(vars); // Actually execute the request
	
	
}